<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Categorie;
use App\Models\Stock\SousCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SousCategoriesController extends Controller
{
    public function add(int $categorie)
    {
        $categorie = Categorie::find($categorie);
        $titre = 'Créer Sous categorie ' . $categorie->nom;
        return view('systeme.stock.categorie.enfant.add', compact('titre', 'categorie'));
    }

    public function edit(int $id)
    {
        $sous_categorie = SousCategorie::with('parent')->find($id);
        $titre = 'Modifier ' . $sous_categorie->nom;
        return view('systeme.stock.categorie.enfant.edit', compact('titre', 'sous_categorie'));
    }

    public function store(Request $request)
    {
        $request->validate(SousCategorie::RULES);
        $sous_categorie = new SousCategorie($request->all());
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/sous_categories', $request->file('image'));
            $sous_categorie->image = Str::substr($path, 7);
        }
        $sous_categorie->user = session('user_id');
        $sous_categorie->save();
        $message = "la sous-catégorie $sous_categorie->nom a été enregistrée avec succès";
        return redirect()->route('categorie_show', $sous_categorie->categorie)->with('success', $message);
    }

    public function update(Request $request)
    {
        $request->validate(SousCategorie::regles($request->sous_categorie));
        $sous_categorie = SousCategorie::find($request->sous_categorie);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $sous_categorie->image);
            $path = Storage::putFile('public/sous_categories', $request->file('image'));
            $sous_categorie->image = Str::substr($path, 7);
        }
        $sous_categorie->nom = $request->nom;
        $sous_categorie->save();
        $message = "la modification de la sous-catégorie a été effectuée avec succès";
        return redirect()->route('categorie_show', $sous_categorie->categorie)->with('success', $message);
    }
}
