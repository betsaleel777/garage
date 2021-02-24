<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Fabricant;
use App\Models\Stock\Piece;
use App\Models\Stock\SousCategorie;
use App\Models\Systeme\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PiecesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {
        $titre = 'Pieces';
        $pieces = Piece::with('categorielinked')->get();
        return view('stock.piece.liste', compact('pieces', 'titre'));
    }

    public function add()
    {
        $titre = 'Nouvelle pièce';
        $data = Fabricant::get()->all();
        $fabricants = array_map(function ($fabricant) {
            return ['label' => $fabricant->nom, 'code' => $fabricant->id];
        }, $data);
        $data = Vehicule::get()->all();
        $vehicules = array_map(function ($vehicule) {
            return ['label' => $vehicule->designation, 'code' => $vehicule->id];
        }, $data);
        return view('stock.piece.add', compact('titre', 'fabricants', 'vehicules'));
    }

    public function store(Request $request)
    {
        $request->validate(Piece::RULES);
        $piece = new Piece($request->all());
        $piece->makeCode();
        if (!empty($request->vehicule)) {
            $piece->vehicule = $request->vehicule;
            $vehicule = Vehicule::findOrFail($request->vehicule);
        } else {
            $request->validate(Vehicule::RULES);
            $vehicule = new Vehicule($request->all());
            $vehicule->user = session('user_id');
            $vehicule->makeName();
            $vehicule->save();
            $piece->vehicule = $vehicule->id;
        }
        $scategorie = SousCategorie::find($request->sous_categorie);
        $piece->makeName($scategorie->slug, $piece->type_piece, $vehicule->designation);
        $piece->user = session('user_id');
        //upload of image
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/pieces', $request->file('image'));
            $piece->image = Str::substr($path, 7);
        }
        $piece->save();
        $message = "la piece $piece->reference a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function edit(int $id)
    {
        $piece = Piece::with(['categorieLinked' => function ($query) {
            $query->select('id', 'nom', 'image');
        }, 'categorieEnfant' => function ($query) {
            $query->select('id', 'nom');
        }])->find($id);
        $titre = 'Modifier ' . $piece->code;
        return view('stock.piece.edit', compact('piece', 'titre'));
    }

    public function update(Request $request)
    {
        $piece = Piece::find($request->piece);
        $piece->description = $request->description;
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $piece->image);
            $path = Storage::putFile('public/pieces', $request->file('image'));
            $piece->image = Str::substr($path, 7);
        }
        $piece->save();
        $message = "la piece $piece->reference a été modifiée avec succès";
        return redirect()->route('pieces')->with('success', $message);
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function forceDelete(int $id)
    {

    }
}
