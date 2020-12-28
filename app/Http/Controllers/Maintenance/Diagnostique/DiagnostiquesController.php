<?php

namespace App\Http\Controllers\Maintenance\Diagnostique;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Diagnostique\Diagnostique;
use App\Models\Maintenance\Intervention;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reparation\Reparation;
use App\Models\Systeme\Atelier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnostiquesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function decompte()
    {
        session()->put('diagnostiques', Reception::diagnosticable()->get()->count());
        session()->put('reparations', Reparation::notFinished()->get()->count());
    }

    public function index()
    {
        $titre = 'Tableau de Diagnostique';
        return view('maintenance.diagnostique.index', compact('titre'));
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'preessai')->diagnosticableAdmin()->get();
        $titre = 'Diagnostiques';
        return view('maintenance.diagnostique.liste', compact('receptions', 'titre'));
    }

    public function complete(int $reception)
    {
        $titre = 'Completer un diagnostique';
        $reception = Reception::with('diagnostique', 'prediagnostique', 'preessai.utilisateur', 'utilisateur', 'vehicule', 'etat', 'personneLinked')->find($reception);
        $ateliers = Atelier::select('id', 'nom')->get();
        $interventions = json_encode([]);
        if (!empty($reception->diagnostique)) {
            $data = Intervention::where('diagnostique', $reception->diagnostique->id)->with('atelierLinked', 'utilisateur')->get()->all();
            $interventions = array_map(function ($element) {
                return [
                    'id' => $element->id,
                    'atelier' => $element->atelierLinked->nom,
                    'utilisateur' => $element->utilisateur->name,
                    'commentaire' => $element->commentaire,
                    'created_from' => $element->created_at->diffForHumans(['parts' => 3, 'short' => true]),
                ];
            }, $data);
            $interventions = json_encode($interventions);
        }
        return view('maintenance.diagnostique.complete', compact('ateliers', 'reception', 'titre', 'interventions'));
    }

    public function fermer(Request $request)
    {
        $request->validate(Diagnostique::RULES);
        $reception = Reception::find($request->reception);
        $diagnostique = Diagnostique::where('reception', $request->reception)->get()->first();
        $diagnostique->panne = $request->panne;
        $diagnostique->temps_estime = $request->temps_estime;
        $diagnostique->valider();
        $diagnostique->save();
        $reception->reparer();
        $reception->save();
        //créer un ordre de travail
        $reparation = new Reparation();
        $reparation->immatriculer();
        $reparation->diagnostique = $reception->diagnostique->id;
        $reparation->reception = $reception->id;
        $reparation->preessai = $reception->preessai->id;
        $reparation->user = Auth::id();
        $reparation->save();
        //créer un devis
        self::decompte();
        $message = "la réception $reception->code a été fermée avec success";
        $new_diagnostique = Diagnostique::find($diagnostique->id);
        $data_diagnostique = [
            'panne' => $new_diagnostique->panne,
            'temps' => $new_diagnostique->temps_estime,
            'closed_from' => $new_diagnostique->updated_at->diffForHumans(['parts' => 3, 'short' => true]),
        ];
        return response()->json(['message' => $message, 'diagnostique' => $data_diagnostique]);
    }

    public function show(int $reception)
    {
        $titre = 'Détails du diagnostique';
        $reception = Reception::with('diagnostique', 'prediagnostique', 'preessai.utilisateur', 'utilisateur', 'vehicule', 'etat', 'personneLinked')->find($reception);
        $interventions = json_encode([]);
        $data = Intervention::where('diagnostique', $reception->diagnostique->id)->with('atelierLinked', 'utilisateur')->get()->all();
        if (!empty($reception->diagnostique)) {
            $interventions = array_map(function ($element) {
                return [
                    'id' => $element->id,
                    'atelier' => $element->atelierLinked->nom,
                    'utilisateur' => $element->utilisateur->name,
                    'commentaire' => $element->commentaire,
                    'created_from' => $element->created_at->diffForHumans(['parts' => 3, 'short' => true]),
                ];
            }, $data);
            $interventions = json_encode($interventions);
        }
        return view('maintenance.diagnostique.show', compact('reception', 'titre', 'interventions'));
    }

    public function findjs(int $reception)
    {
        $reception = Reception::find($reception);
        $diagnostique = Diagnostique::where('reception', $reception)->get()->first();
        $data_diagnostique = [
            'panne' => $diagnostique->panne,
            'temps' => $diagnostique->temps_estime,
            'closed_from' => $diagnostique->updated_at->diffForHumans(['parts' => 3, 'short' => true]),
        ];
        return response()->json(['diagnostique' => $data_diagnostique]);
    }
}
