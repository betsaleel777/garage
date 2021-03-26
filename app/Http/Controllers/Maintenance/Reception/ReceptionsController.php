<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reception\CommentaireReception;
use App\Models\Maintenance\Reception\Enjoliveur;
use App\Models\Maintenance\Reception\EtatVehicule;
use App\Models\Maintenance\Reception\MediaReception;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reception\VehiculeInfo;
use App\Models\Maintenance\Reception\VehiculeReception;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    const CATEGORIES_VEHICULES = [
        'citadine',
        'berline break',
        'berline familliale',
        'berline grande routière',
        'berline limousine',
        'SUV urbains',
        'SUV familiaux',
        'SUV 4x4',
        'monospace',
        'ludospace',
        'coupé',
        'cabriolet',
        'utilitaire',
        'utilitaire léger',
        'camion',
    ];
    /**
     * cette fonction permet de mettre à jours le nombre de receptions et les essais avant réparations non traités
     */
    private static function decompte()
    {
        session()->put('receptions', Reception::recent()->get()->count());
        $preessais = Reception::preEssayable()->get()->count();
        $postessais = Reception::postEssayable()->get()->count();
        session()->put('essais', $preessais + $postessais);
    }

    private static function downloadableMedia(array $medias)
    {
        $downloadExtensions = ['docx', 'pdf', 'txt', 'odt', 'doc', 'zip', '7z', 'rar'];
        return array_values(array_filter(array_map(function ($file) use ($downloadExtensions) {
            $exploded = explode('.', $file->media);
            $caption = $exploded[0];
            $extension = $exploded[1];
            if (in_array($extension, $downloadExtensions)) {
                return ['nom' => $caption, 'media' => $file->media];
            }
        }, $medias)));
    }

    private static function boxFormater(array $medias): array
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        $videoExtensions = ['3gp', 'avi', 'mp4', 'ogg'];
        $mimes = ['3gp' => 'video/3gpp', 'avi' => 'video/x-msvideo', 'mp4' => 'video/mp4', 'ogg' => 'application/ogg'];
        $baseUrl = 'media_reception/';
        return array_values(array_filter(array_map(function ($file) use ($imageExtensions, $videoExtensions, $mimes, $baseUrl) {
            $exploded = explode('.', $file->media);
            $caption = $exploded[0];
            $extension = $exploded[1];
            if (in_array($extension, $imageExtensions)) {
                return [
                    'thumb' => $baseUrl . $file->media,
                    'src' => $baseUrl . $file->media,
                    'caption' => $caption,
                    'type' => 'image',
                ];
            } else if (in_array($extension, $videoExtensions)) {
                return [
                    'src' => $baseUrl . $file->media,
                    'type' => 'video',
                    'caption' => $caption,
                ];
            }
        }, $medias)));

    }

    public function index()
    {
        $titre = 'Tableau des réceptions';
        return view('maintenance.reception.index', compact('titre'));
    }

    public function add()
    {
        $titre = 'Ajouter une réception';
        $categories = self::CATEGORIES_VEHICULES;
        $enjoliveurs = Enjoliveur::get();
        return view('maintenance.reception.add', compact('titre', 'categories', 'enjoliveurs'));
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'vehicule.auto')->get();
        $titre = 'Liste Réception';
        return view('maintenance.reception.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        //validation des données
        if (!isset($request->vehicule)) {
            $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES, VehiculeReception::RULES, MediaReception::RULES);
        } else {
            $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES, MediaReception::RULES);
        }
        $request->validate($rules);
        //recupération du client si déjà existant et creation de nouveau client sinon
        if (!empty($request->telephone)) {
            $data = Personne::where('telephone', $request->telephone)->get()->first();
        } elseif (!empty($request->contact_entreprise)) {
            $data = Personne::orWhere('contact_entreprise', $request->contact_entreprise)->get()->first();
        } elseif (!empty($request->contact_assurance)) {
            $data = Personne::where('contact_assurance', $request->contact_assurance)->get()->first();
        } else {
            $message = "le client n'a pas été selectionné";
            return redirect()->back()->with('danger', $message)->withInput();
        }
        if (empty($data)) {
            $personne = new Personne($request->all());
            $personne->immatriculer();
            $personne->save();
        } else {
            $personne = $data;
        }

        //si un ancien véhicule n'as pas été sélectioné
        if (!isset($request->vehicule)) {
            $vehicule = new VehiculeReception($request->all());
            $vehicule->personne = $personne->id;
            $vehicule->user = session('user_id');
            $vehicule->save();
            $vehicule_info = new VehiculeInfo($request->all());
            $vehicule_info->vehicule = $vehicule->id;
            $vehicule_info->save();

        } else {
            $vehicule_info = new VehiculeInfo($request->all());
            $vehicule_info->vehicule = $request->vehicule;
            $vehicule_info->save();
        }

        //enregistrement des enjoliveurs
        foreach (array_values($request->only('enjoliveur')) as $value) {
            $vehicule_info->enjoliveurs()->sync($value);
        }
        //nouveau etat de vehicule
        $etat_vehicule = EtatVehicule::create($request->all());

        //creation de la reception
        $reception = new Reception($request->all());
        $reception->immatriculer();
        $reception->personne = $personne->id;
        $reception->etat_vehicule = $etat_vehicule->id;
        $reception->vehicule_info = $vehicule_info->id;
        $reception->user = session('user_id');
        $reception->save();

        //commentaire de receptionniste
        if (!empty($request->contenu)) {
            $commentaire = new CommentaireReception($request->all());
            $commentaire->reception = $reception->id;
            $commentaire->user = session('user_id');
            $commentaire->save();
            if (!empty($request->images)) {
                foreach ($request->images as $image) {
                    $nom = explode('/', $image)[2];
                    Storage::move('public/temporaire/' . $nom, 'public/media_reception/' . $nom);
                    $media = new MediaReception();
                    $media->commentaire = $commentaire->id;
                    $media->media = $nom;
                    $media->save();
                    //optimisation: vider si il y a d'autre qui sont resté
                }
            }
        }
        self::decompte();
        $message = "la réception $reception->code a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function edit(int $id)
    {
        //verifier si utilisateur a cet droit
        $reception = Reception::with('vehicule.enjoliveurs', 'etat', 'personneLinked')->find($id);
        $personnes = Personne::get()->pluck('matricule', 'id');
        $titre = 'Modifier ' . $reception->code;
        $categories = self::CATEGORIES_VEHICULES;
        $enjoliveurs = Enjoliveur::get();
        return view('maintenance.reception.edit', compact('enjoliveurs', 'personnes', 'categories', 'reception', 'titre'));
    }

    public function update(Request $request)
    {
        $reception = Reception::find($request->reception);
        $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES);
        $request->validate($rules);

        //modification de reception
        $data_to_update = $request->only('nom_deposant', 'ressenti');
        Reception::where('id', $request->reception)->update($data_to_update);

        //modification de vehicule_info
        $data_to_update = $request->only(
            'nom_deposant', 'niveau_carburant', 'immatriculation',
            'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel', 'prochaine_vidange',
            'marque', 'modele', 'type_vehicule', 'annee', 'couleur'
        );
        VehiculeInfo::where('id', $reception->vehicule_info)->update($data_to_update);
        //modifier le choix des enjoliveurs
        $vehicule_info = VehiculeInfo::find($reception->vehicule_info);
        foreach (array_values($request->only('enjoliveur')) as $value) {
            $vehicule_info->enjoliveurs()->sync($value);
        }

        //modification de etat_vehicule
        $data_to_update = $request->except(
            '_token', 'reception', 'nom_deposant', 'ressenti', 'enjoliveur', 'niveau_carburant',
            'immatriculation', 'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel',
            'prochaine_vidange', 'personne', 'marque', 'modele', 'type_vehicule', 'annee', 'couleur'
        );
        EtatVehicule::where('id', $reception->etat_vehicule)->update($data_to_update);

        $message = "la réception $reception->code a été modifiée avec succès";
        return redirect()->route('reception_show', $reception)->with('success', $message);
    }

    public function show(int $id)
    {
        $reception = Reception::with('commentaire.medias', 'vehicule.enjoliveurs', 'vehicule.auto', 'etat', 'personneLinked')->find($id);
        $enjoliveurs = join(',', array_map(function ($enjoliveur) {
            return $enjoliveur->nom;
        }, $reception->vehicule->enjoliveurs->all()));
        $titre = 'Réception ' . $reception->code;
        $boxData = self::boxFormater($reception->commentaire->medias->all());
        $downloadables = self::downloadableMedia($reception->commentaire->medias->all());
        return view('maintenance.reception.show', compact('enjoliveurs', 'reception', 'titre', 'boxData', 'downloadables'));
    }

    public function delete(int $id)
    {
        //suppression possible si l'etat de validation est non validé
        $reception = Reception::find($id);
        $etat_vehicule = EtatVehicule::find($reception->etat_vehicule);
        $vehicule_info = VehiculeInfo::find($reception->vehicule_info);
        $reception->delete();
        $etat_vehicule->delete();
        $vehicule_info->delete();
        $message = "la réception $reception->code a été supprimée avec succès";
        return response()->json(['message' => $message]);
    }

    public function forceDelete(int $id)
    {
        $reception = Reception::find($id);
        $etat_vehicule = EtatVehicule::find($reception->etat_vehicule);
        $vehicule_info = VehiculeInfo::find($reception->vehicule_info);
        $reception->delete();
        $etat_vehicule->delete();
        $vehicule_info->delete();
        $message = "la reception a été supprimée avec succès";
        self::decompte();
        session()->flash('success', $message);
        return;
    }

    function print(int $id) {
        $reception = Reception::with('commentaire.medias', 'vehicule.enjoliveurs', 'vehicule.auto', 'etat', 'personneLinked')->find($id);
        $enjoliveurs = join(',', array_map(function ($enjoliveur) {
            return $enjoliveur->nom;
        }, $reception->vehicule->enjoliveurs->all()));
        $titre = "$reception->code";
        return view('maintenance.reception.print', compact('enjoliveurs', 'reception', 'titre'));
        // $pdf = PDF::loadView('maintenance.reception.pdf', ['enjoliveurs' => $enjoliveurs, 'reception' => $reception]);
        // return $pdf->download($reception->code);
    }

    public function findjs(int $id)
    {
        $reception = Reception::find($id);
        return response()->json(['reception' => $reception]);
    }

    public function vehiculesFrom(int $id)
    {
        $vehicules = Personne::with('vehicules')->find($id)->vehicules;
        return response()->json(['vehicules' => $vehicules]);
    }

    public function uploadAddjs(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = Storage::putFile('public/temporaire', $request->file('file'));
        }
        return response()->json(['chemin' => $path]);
    }

    public function uploadRemovejs(Request $request)
    {
        return response()->json([$request->all()]);
    }
}
