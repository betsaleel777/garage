<?php

namespace App\Http\Controllers\Maintenance\Reparation;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Intervention;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reparation\Reparation;
use App\Models\Maintenance\Reparation\ReparationTerminee;
use App\Models\Systeme\Atelier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReparationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function decompte()
    {
        session()->put('reparations', Reparation::notFinished()->get()->count());
        session()->put('essais', Reception::preEssayable()->get()->count() + Reception::postEssayable()->get()->count());
    }

    public function index()
    {
        $titre = 'Tableau de reparation';
        return view('maintenance.reparation.index', compact('titre'));
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'preessai')->reparableAdmin()->get();
        $titre = 'Réparations';
        return view('maintenance.reparation.liste', compact('receptions', 'titre'));
    }

    public function complete(int $reception)
    {
        $titre = 'Completer une réparation';
        $reception = Reception::with('reparation', 'diagnostique', 'prediagnostique', 'preessai.utilisateur', 'utilisateur', 'vehicule', 'etat', 'personneLinked')->find($reception);
        $ateliers = Atelier::select('id', 'nom')->get();
        //interventions de diagnostique
        $interventions_diagnostique = json_encode([]);
        $data = Intervention::where('diagnostique', $reception->diagnostique->id)->with('atelierLinked', 'utilisateur')->get()->all();
        $interventions_diagnostique = array_map(function ($element) {
            return [
                'id' => $element->id,
                'atelier' => $element->atelierLinked->nom,
                'utilisateur' => $element->utilisateur->name,
                'commentaire' => $element->commentaire,
                'created_from' => $element->created_at->diffForHumans(['parts' => 3, 'short' => true]),
            ];
        }, $data);
        $interventions_diagnostique = json_encode($interventions_diagnostique);

        $interventions = json_encode([]);
        $data = Intervention::where('reparation', $reception->reparation->id)->with('atelierLinked', 'utilisateur')->get()->all();
        if (!empty($data)) {
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
        return view('maintenance.reparation.complete', compact('ateliers', 'reception', 'titre', 'interventions_diagnostique', 'interventions'));
    }

    public function show(int $reception)
    {
        $reception = Reception::with('reparation', 'diagnostique', 'prediagnostique', 'preessai.utilisateur', 'utilisateur', 'vehicule', 'etat', 'personneLinked')->find($reception);
        $titre = 'Réparation ' . $reception->code;
        $interventions_diagnostique = json_encode([]);
        $data = Intervention::where('diagnostique', $reception->diagnostique->id)->with('atelierLinked', 'utilisateur')->get()->all();
        $interventions_diagnostique = array_map(function ($element) {
            return [
                'id' => $element->id,
                'atelier' => $element->atelierLinked->nom,
                'utilisateur' => $element->utilisateur->name,
                'commentaire' => $element->commentaire,
                'created_from' => $element->created_at->diffForHumans(['parts' => 3, 'short' => true]),
            ];
        }, $data);
        $interventions_diagnostique = json_encode($interventions_diagnostique);

        $interventions = json_encode([]);
        $data = Intervention::where('reparation', $reception->reparation->id)->with('atelierLinked', 'utilisateur')->get()->all();
        if (!empty($data)) {
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
        $resume = ReparationTerminee::where('reparation', $reception->reparation->id)->get()->first();
        return view('maintenance.reparation.show', compact('reception', 'titre', 'interventions_diagnostique', 'interventions', 'resume'));
    }

    /**verification des pieces utilises si utilisé moins que prévue envoyé créer un retour de stock
     **/
    public function fermer(Request $request)
    {
        $request->validate(ReparationTerminee::RULES);
        $reception = Reception::find($request->reception);
        $reception->statut = $reception::STATUS_REPARATION_DOWN;
        $reception->save();
        $reparation = Reparation::where('reception', $reception->id)->get()->first();
        $reparation->finir();
        $reparation->save();
        //enregistrer la fermeture
        $finished = new ReparationTerminee($request->all());
        $finished->user = Auth::id();
        $finished->reparation = $reparation->id;
        $finished->save();
        //modification des interventions liées
        $interventions = Intervention::where('reparation', $reparation->id)->get();
        foreach ($interventions as $intervention) {
            $intervention->reparation_terminee = $finished->id;
            $intervention->save();
        }
        self::decompte();
        $resume = ReparationTerminee::find($finished->id);
        $data_resume = [
            'texte' => $resume->texte,
            'user' => Auth::user()->name,
            'closed_from' => $resume->created_at->diffForHumans(['parts' => 3, 'short' => true]),
        ];
        $message = "la fin des travaux concernant la réparation: $reparation->code a été enregistrée avec succès";
        return response()->json(['message' => $message, 'resume' => $data_resume]);
    }
}
