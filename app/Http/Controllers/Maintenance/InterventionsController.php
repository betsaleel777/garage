<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Diagnostique\Diagnostique;
use App\Models\Maintenance\Intervention;
use App\Models\Maintenance\Reception\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionsController extends Controller
{
    public function storejs(Request $request)
    {
        $request->validate(Intervention::RULES);
        $intervention = new Intervention($request->all());
        $reception = Reception::with('diagnostique')->find($request->reception);
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        if (empty($reception->diagnostique)) {
            $diagnostique = new Diagnostique($request->all());
            $diagnostique->user = $user_id;
            $diagnostique->save();
            $intervention->diagnostique = $diagnostique->id;
        } else {
            $intervention->diagnostique = $reception->diagnostique->id;
        }
        $intervention->user = $user_id;
        $intervention->save();
        $new_intervention = Intervention::with('atelierLinked')->find($intervention->id);
        $intervention = [
            'id' => $new_intervention->id,
            'atelier' => $new_intervention->atelierLinked->nom,
            'utilisateur' => $user_name,
            'commentaire' => $new_intervention->commentaire,
            'created_from' => $new_intervention->created_at->diffForHumans(['parts' => 3, 'short' => true]),
        ];
        $message = "l'utilisateur $user_name de l'atelier " . $new_intervention->atelierLinked->nom . " vient d'enregistrer une intervention.";
        return response()->json(['message' => $message, 'intervention' => $intervention]);
    }
}
