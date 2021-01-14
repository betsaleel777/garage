<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Fournisseur;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fournisseurs = Fournisseur::get();
        $titre = 'Fournisseurs';
        return view('systeme.stock.fournisseur.index', compact('fournisseurs', 'titre'));
    }

    public function add()
    {
        $titre = 'Créer fournisseur';
        return view('systeme.stock.fournisseur.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Fournisseur::RULES);
        $fournisseur = new Fournisseur($request->all());
        $fournisseur->user = session('user_id');
        $fournisseur->save();
        $message = " le fournisseur $request->nom a été crée avec succès!";
        return redirect()->route('fournisseurs')->with('sucess', $message);
    }

    public function edit(int $id)
    {
        $fournisseur = Fournisseur::find($id);
        $titre = 'Modifier ' . $fournisseur->nom;
        return view('systeme.stock.fournisseur.edit', compact('fournisseur', 'titre'));
    }

    public function update(Request $request)
    {
        $request->validate(Fournisseur::regles($request->fournisseur));
        Fournisseur::where('id', $request->fournisseur)->update($request->except('_token', 'fournisseur'));
        $message = " la modification du fournisseur a été effectuée avec succès avec succès!";
        return redirect()->route('fournisseurs')->with('sucess', $message);
    }

}
