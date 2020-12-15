<?php

namespace App\Http\Controllers\Maintenance\Diagnostique;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Diagnostique\Prediagnostique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrediagnostiquesController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $request->validate(Prediagnostique::RULES);
        $prediagnostique = new Prediagnostique($request->all());
        $prediagnostique->user = Auth::id();
        $prediagnostique->save();
        $message = "Les données de la Checklist de pré-diagnostique on été enregistrées avec succès";
        return redirect()->route('diagnostique_complete', $request->reception)->with('success', $message)->withInput();
    }

    public function update(Request $request)
    {
        $request->validate(Prediagnostique::RULES);
        Prediagnostique::where('id', $request->prediagnostique)->update($request->all());
        $message = "Les données de la Checklist de pré-diagnostique on été enregistrées avec succès";
        return redirect()->route('diagnostique_complete', $request->reception)->with('success', $message)->withInput();

    }
}
