<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Catégories de pièces';
        $categories = Categorie::get();
        return view('systeme.stock.categorie.index', compact('categories', 'titre'));
    }

    public function add()
    {
        $titre = 'Nouvelle Catégorie piece';
        return view('systeme.stock.categorie.add', compact('titre'));
    }

    public function edit(int $id)
    {
        $categorie = Categorie::find($id);
        $titre = 'Modifier ' . $categorie->nom;
        return view('systeme.stock.categorie.edit', compact('categorie', 'titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Categorie::RULES);
        $categorie = new Categorie($request->all());
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/categories', $request->file('image'));
            $categorie->image = Str::substr($path, 7);
        }
        $categorie->save();
        $message = "La nouvelle catégorie de pièce détachées '$categorie->nom' de véhicule a été enregistrée";
    }

    public function update(Request $request)
    {
        $request->validate(Categorie::regles($request->categorie));
        $categorie = Categorie::find($request->categorie);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $categorie->image);
            $path = Storage::putFile('public/categories', $request->file('image'));
            $categorie->image = Str::substr($path, 7);
        }
        $categorie->nom = $request->nom;
        $categorie->save();
        $message = "les modifications ont été effectuées avec succès";
        return redirect()->route('categories')->with('success', $message);
    }

    public function show(int $id)
    {
        $categorie = Categorie::with('enfants')->find($id);
        $titre = 'Détails ' . $categorie->nom;
        return view('systeme.stock.categorie.show', compact('titre', 'categorie'));
    }
}
