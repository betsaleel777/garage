<?php

namespace App\Http\Controllers\Maintenance\Essai;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Essai\Preessai;
use App\Models\Maintenance\Reception\Reception;
use Illuminate\Http\Request;

class PreessaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function decompte()
    {
        session()->put('essais', Reception::preEssayable()->get()->count() + Reception::postEssayable()->get()->count());
        session()->put('diagnostiques', Reception::diagnosticable()->get()->count());
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'preessai')->orderBy('id', 'desc')->preEssayableAdmin()->get();
        //retirer les reception déjà liée à un preessai
        $titre = 'Essais avant réparations';
        return view('maintenance.essais.pre.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        $request->validate(Preessai::RULES);
        $reception = Reception::find($request->reception);
        $preessai = new Preessai($request->all());
        $preessai->user = session('user_id');
        $preessai->save();
        self::decompte();
        $message = "Un essais avant réparation vient d'être enregistré avec succès pour la reception: $reception->code";
        session()->flash('success', $message);
        return;
    }

    public function update(Request $request)
    {
        $request->validate(Preessai::RULES);
        $reception = Reception::with('preessai')->find($request->reception);
        $preessai = Preessai::find($reception->preessai->id);
        $preessai->commentaire = $request->commentaire;
        $preessai->save();
        $message = "l'essais concernant la reception $reception->code a été mis à jour.";
        session()->flash('success', $message);
        return;
    }

    //post essais functions

}
