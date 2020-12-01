<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reception\EtatVehicule;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reception\VehiculeInfo;
use App\Models\Personne;
use App\Models\Systeme\TypesReparation;
use Illuminate\Http\Request;

class ReceptionsController extends Controller
{

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
        $receptions = Reception::get();
        $titre = 'Liste Réception';
        return view('maintenance.reception.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        $rules = array_merge(VehiculeInfo::RULES, EtatVehicule::RULES, Reception::RULES);
        $request->validate($rules);
        $personne = Personne::orWhere('telephone', $request->telephone)
            ->orWhere('contact_entreprise', $request->contact_entreprise)
            ->orWhere('contact_assurance', $request->contact_assurance)
            ->get()->first();
        $personne = empty($personne) ? Personne::create($request->all()) : $personne;
        $vehicule_info = VehiculeInfo::create($request->all());
        $etat_vehicule = EtatVehicule::create($request->all());
        $reception = new Reception($request->all());
        $reception->immatriculer();
        $reception->personne = $personne->id;
        $reception->etat_vehicule = $etat_vehicule->id;
        $reception->vehicule_info = $vehicule_info->id;
        $reception->save();
        $message = "la réception $reception->code a été enregistrée avec succès.";
        return redirect()->route('reception_liste')->with('success', $message)->withInput();
    }

    public function edit()
    {
        $titre = '';
    }

    public function update(Request $request)
    {

    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
