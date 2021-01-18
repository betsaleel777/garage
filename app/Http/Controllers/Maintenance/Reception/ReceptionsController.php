<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reception\Enjoliveur;
use App\Models\Maintenance\Reception\EtatVehicule;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reception\VehiculeInfo;
use App\Models\Personne;
use Illuminate\Http\Request;

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

    public static function decompte()
    {
        session()->put('receptions', Reception::recent()->get()->count());
        session()->put('essais', Reception::preEssayable()->get()->count() + Reception::postEssayable()->get()->count());
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
        $vehicule_info = VehiculeInfo::select('immatriculation')->get()->all();
        $immatriculations = array_map(function ($info) {
            return $info->immatriculation;
        }, $vehicule_info);
        return view('maintenance.reception.add', compact('immatriculations', 'titre', 'categories', 'enjoliveurs'));
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'vehicule')->get();
        $titre = 'Liste Réception';
        return view('maintenance.reception.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        //validation des données
        $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES);
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
            $personne = new Personne($request->except('enjoliveur'));
            $personne->immatriculer();
            $personne->save();
        } else {
            $personne = $data;
        }

        //recupération du véhicule si déjà existant et creation de nouveau véhicule sinon
        $vehicule_info = VehiculeInfo::where('chassis', $request->chassis)->get()->first();
        if (empty($vehicule_info)) {
            $vehicule_info = VehiculeInfo::create($request->except('enjoliveur'));
        } else {
            $vehicule_info->date_sitca = $request->date_sitca;
            $vehicule_info->date_assurance = $request->date_assurance;
            $vehicule_info->kilometrage_actuel = $request->kilometrage_actuel;
            $vehicule_info->prochaine_vidange = $request->prochaine_vidange;
            $vehicule_info->niveau_carburant = $request->niveau_carburant;
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
        self::decompte();
        $message = "la réception $reception->code a été enregistrée avec succès.";
        return redirect()->route('reception_liste')->with('success', $message)->withInput();
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
        $reception = Reception::with('vehicule.enjoliveurs', 'etat', 'personneLinked')->find($id);
        $enjoliveurs = join(',', array_map(function ($enjoliveur) {
            return $enjoliveur->nom;
        }, $reception->vehicule->enjoliveurs->all()));
        $titre = 'Réception ' . $reception->code;
        return view('maintenance.reception.show', compact('enjoliveurs', 'reception', 'titre'));
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

    // public function valider(int $id)
    // {
    //     // cette action est impossible si pas admin
    //     $reception = Reception::find($id);
    //     $reception->receptionner();
    //     $reception->save();
    //     self::decompte();
    //     $message = "la reception $reception->code a été validée avec succès";
    //     return redirect()->route('reception_liste')->with('success', $message);
    // }

    function print(int $id) {
        $reception = Reception::with('vehicule.enjoliveurs', 'etat', 'personneLinked')->find($id);
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

    public function findVehiculejs(string $matricule)
    {
        $vehicule = VehiculeInfo::firstWhere('immatriculation', $matricule);
        return response()->json(['vehicule' => $vehicule]);
    }
}
