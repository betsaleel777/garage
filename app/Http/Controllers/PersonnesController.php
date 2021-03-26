<?php

namespace App\Http\Controllers;

use App\Models\Maintenance\Reception\VehiculeReception;
use App\Models\Personne;
use Illuminate\Http\Request;

class PersonnesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function add()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(int $id)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(int $id)
    {

    }

    public function findjs($critere)
    {
        $personne = Personne::orWhere('telephone', $critere)
            ->orWhere('contact_entreprise', $critere)
            ->orWhere('contact_assurance', $critere)
            ->orWhere('nom_complet', $critere)
            ->orWhere('nom_assurance', $critere)
            ->orWhere('nom_entreprise', $critere)
            ->get()->first();
        $vehicule = false;
        $nature = null;
        if (!empty($personne)) {
            $nature = $personne->nature();
        } else {
            $vehicule = VehiculeReception::with('personneLinked')->where('immatriculation', $critere)->get()->first();
            $personne = $vehicule?->personneLinked;
            empty($personne) ? $personne = false : $nature = $personne->nature();
        }
        return response()->json(['personne' => $personne, 'nature' => $nature, 'vehicule' => $vehicule]);
    }

    public function suggestjs()
    {
        $personnes = Personne::with(['vehicules' => function ($query) {$query->select('id', 'personne', 'immatriculation');}])->get();
        $suggestions = [];
        foreach ($personnes as $personne) {
            //les noms
            if (!empty($personne->nom_complet)) {
                array_push($suggestions, $personne->nom_complet);
            } elseif (!empty($personne->nom_assurance)) {
                array_push($suggestions, $personne->nom_assurance);
            } elseif (!empty($personne->nom_entreprise)) {
                array_push($suggestions, $personne->nom_entreprise);
            }

            //les contacts
            if (!empty($personne->telephone)) {
                array_push($suggestions, $personne->telephone);
            } elseif (!empty($personne->contact_assurance)) {
                array_push($suggestions, $personne->contact_assurance);
            } elseif (!empty($personne->contact_entreprise)) {
                array_push($suggestions, $personne->contact_entreprise);
            }

            //les immatriculations
            if (!empty($personne->vehicules->all())) {
                foreach ($personne->vehicules as $vehicule) {
                    array_push($suggestions, $vehicule->immatriculation);
                }
            }
        }
        return response()->json(['suggestions' => $suggestions]);
    }

    public function storejs(Request $request)
    {
        $request->validate(Personne::RULES);
        $personne = new Personne($request->all());
        $personne->immatriculer();
        $personne->save();
        $message = 'le client a été crée avec succès';
        return response()->json(['message' => $message]);
    }
}
