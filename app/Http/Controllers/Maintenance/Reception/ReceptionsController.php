<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reception\EtatVehicule;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reception\VehiculeInfo;
use App\Models\Personne;
use App\Models\Systeme\TypesReparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function cars()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://private-anon-24cefce97e-carsapi1.apiary-mock.com/cars");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function index()
    {
        $titre = 'Tableau des réceptions';
        return view('maintenance.reception.index', compact('titre'));
    }

    public function add()
    {
        $titre = 'Ajouter une réception';
        $niveaux = [0, 1 / 4, 1 / 2, 3 / 4, 1];
        $etats = ["inexistant", "bon", "passable", "mauvais"];
        $types = TypesReparation::get()->pluck('nom', 'id');
        return view('maintenance.reception.add', compact('titre', 'etats', 'niveaux', 'types'));
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'reparation', 'preessai')->get();
        $titre = 'Liste Réception';
        return view('maintenance.reception.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES, Reception::RULES);
        $request->validate($rules);
        if (!empty($request->telephone)) {
            $data = Personne::where('telephone', $request->telephone)->get()->first();
        } elseif (!empty($request->contact_entreprrise)) {
            $data = Personne::orWhere('contact_entreprise', $request->contact_entreprise)->get()->first();
        } elseif (!empty($request->contact_assurance)) {
            $data = Personne::where('contact_assurance', $request->contact_assurance)->get()->first();
        }

        if (empty($data)) {
            $personne = new Personne($request->all());
            $personne->immatriculer();
            $personne->save();
        } else {
            $personne = $data;
        }
        $etat_vehicule = EtatVehicule::create($request->all());
        $vehicule_info = VehiculeInfo::create($request->all());
        $reception = new Reception($request->all());
        $reception->immatriculer();
        $reception->personne = $personne->id;
        $reception->etat_vehicule = $etat_vehicule->id;
        $reception->vehicule_info = $vehicule_info->id;
        $reception->user = Auth::id();
        $reception->save();
        $message = "la réception $reception->code a été enregistrée avec succès.";
        return redirect()->route('reception_liste')->with('success', $message)->withInput();
    }

    public function edit(int $id)
    {
        //verifier si utilisateur a cet droit
        $reception = Reception::with('vehicule', 'reparation', 'etat', 'personneLinked')->find($id);
        $personnes = Personne::get()->pluck('matricule', 'id');
        $titre = 'Modifier ' . $reception->code;
        $niveaux = [0, 1 / 4, 1 / 2, 3 / 4, 1];
        $etats = ["inexistant", "bon", "passable", "mauvais"];
        $types = TypesReparation::get()->pluck('nom', 'id');
        return view('maintenance.reception.edit', compact('personnes', 'reception', 'titre', 'etats', 'niveaux', 'types'));
    }

    public function update(Request $request)
    {
        $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES, Reception::RULES);
        $request->validate($rules);
        $reception = Reception::find($request->reception);

        //modification de reception
        $data_to_update = $request->only('nom_deposant', 'type_reparation', 'ressenti');
        Reception::where('id', $request->reception)->update($data_to_update);

        //modification de vehicule_info
        $data_to_update = $request->only(
            'nom_deposant', 'enjoliveur', 'niveau_carburant', 'vehicule', 'immatriculation',
            'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel', 'prochaine_vidange', 'date_reception'
        );
        VehiculeInfo::where('id', $reception->vehicule_info)->update($data_to_update);

        //modification de etat_vehicule
        $data_to_update = $request->except(
            '_token', 'reception', 'nom_deposant', 'type_reparation', 'ressenti', 'enjoliveur', 'niveau_carburant',
            'vehicule', 'immatriculation', 'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel',
            'prochaine_vidange', 'personne', 'date_reception'
        );
        EtatVehicule::where('id', $reception->etat_vehicule)->update($data_to_update);

        $message = "la réception $reception->code a été modifiée avec succès";
        return redirect()->route('reception_show', $reception)->with('success', $message);
    }

    public function show(int $id)
    {
        $reception = Reception::with('vehicule', 'reparation', 'etat', 'personneLinked', 'preessai')->find($id);
        $titre = 'Réception ' . $reception->code;
        return view('maintenance.reception.show', compact('reception', 'titre'));
    }

    public function delete(int $id)
    {
        //suppression possible si l'etat de validation est non validé
        $reception = Reception::find($id);
        if (!$reception->est_valide()) {
            $etat_vehicule = EtatVehicule::find($reception->etat_vehicule);
            $vehicule_info = VehiculeInfo::find($reception->vehicule_info);
            $reception->delete();
            $etat_vehicule->delete();
            $vehicule_info->delete();
            $message = "la réception $reception->code a été supprimée avec succès";
            return;
        } else {
            //si utilisateur n'est pas chef receptionniste ou chef technique ou admin élohim, il ne peut forcer la suppression d'une telle réception
            $message = "la reception $reception->code ne peut être supprimée car elle a déjà été validée, cette réception pourrais être liée à d'autre module de l'application";
            return response()->json(['message' => $message]);
        }
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
        session()->flash('success', $message);
        return;
    }

    public function valider(int $id)
    {
        // cette action est impossible si pas admin
        $reception = Reception::find($id);
        $reception->valider();
        $reception->save();
        $message = "la reception $reception->code a été validée avec succès";
        return redirect()->route('reception_edit', $id)->with('success', $message);
    }

    function print(int $id) {
        $reception = Reception::with('vehicule', 'reparation', 'etat', 'personneLinked', 'preessai')->find($id);
        $titre = "$reception->code";
        return view('maintenance.reception.print', compact('reception', 'titre'));
    }
}
