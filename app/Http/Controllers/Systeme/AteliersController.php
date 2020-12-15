<?php

namespace App\Http\Controllers\Systeme;

use App\Http\Controllers\Controller;
use App\Models\Systeme\Atelier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AteliersController extends Controller
{
    public function index()
    {
        $titre = 'Ateliers';
        $ateliers = Atelier::orderBy('surcusale')->get();
        return view('systeme.atelier.index', compact('titre', 'ateliers'));
    }

    public function add()
    {
        $titre = 'Nouveau atelier de réparation';
        return view('systeme.atelier.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Atelier::RULES);
        $atelier = new Atelier($request->all());
        $atelier->user = Auth::id();
        $atelier->save();
        $message = "l'atelier nommé $request->nom a été enregistré avec succès";
        return redirect()->route('ateliers')->with('success', $message)->withInput();
    }

    public function edit(int $id)
    {
        $atelier = Atelier::find($id);
        $titre = 'Modifier ' . $atelier->nom;
        return view('systeme.atelier.edit', compact('titre', 'atelier'));
    }

    public function update(Request $request)
    {
        $atelier = Atelier::find($request->atelier);
        $request->validate(Atelier::RULES);
        $atelier->nom = $request->nom;
        $atelier->description = $request->description;
        $atelier->save();
        $message = 'Modification éffectuée avec succès';
        return redirect()->route('ateliers')->with('success', $message)->withInput();
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
