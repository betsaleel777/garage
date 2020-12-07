<?php

namespace App\Http\Controllers\Maintenance\Essai;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Essai\Preessai;
use App\Models\Maintenance\Reception\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreessaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {
        $preessais = Preessai::with('receptionLinked', 'utilisateur')->get();
        $titre = 'Liste Pressais';
        return view('maintenance.essais.pre.liste', compact('titre', 'preessais'));
    }

    public function add()
    {
        $titre = 'Nouvel essai';
        $receptions = Reception::get()->pluck('code', 'id');
        return view('maintenance.essais.pre.add', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        $request->validate(Preessai::RULES);
        $reception = Reception::with('preessai')->find($request->reception);

        if (empty($reception->preessai)) {
            $preessai = new Preessai($request->all());
            $preessai->immatriculer();
            $preessai->user = Auth::id();
            $preessai->save();
            $message = "Le pré-diagnostique $preessai->code a été enregistré avec succès";
            return redirect()->route('reception_liste')->with('success', $message)->withInput();
        } else {
            $message = "Un pré-diagnostique a déjà été enregistré pour la réception $reception->code, suivre le lien ci après pour procéder à une modification du pré-diagnostique";
            session()->flash('lien', '/maintenance/essai/pre/edit/' . $reception->preessai->id);
            return redirect()->back()->with('warning', $message)->withInput();
        }
    }

    public function edit(int $id)
    {
        $preessai = Preessai::find($id);
        $receptions = Reception::get()->pluck('code', 'id');
        $titre = 'Modifier ' . $preessai->code;
        return view('maintenance.essais.pre.edit', compact('preessai', 'titre', 'receptions'));
    }

    public function update(Request $request)
    {
        $preessai = Preessai::select('id', 'code')->find($request->preessai);
        $request->validate(Preessai::RULES);
        $data_preessai = $request->except('_token', 'preessai');
        Preessai::where('id', $request->preessai)->update($data_preessai);
        $message = "le pré-diagnostique $preessai->code a été modifié avec succès";
        return redirect()->route('preessai_edit', $preessai->id)->with('success', $message);
    }

    //post essais functions

}
