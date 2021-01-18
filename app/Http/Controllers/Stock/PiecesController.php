<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use App\Models\Stock\SousCategorie;
use App\Models\Systeme\Vehicule;
use Illuminate\Http\Request;

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
        $data = Magasin::get()->all();
        $magasins = array_map(function ($magasin) {
            return ['label' => $magasin->nom, 'code' => $magasin->id];
        }, $data);
        $data = Vehicule::get()->all();
        $vehicules = array_map(function ($vehicule) {
            return ['label' => $vehicule->designation, 'code' => $vehicule->id];
        }, $data);
        return view('stock.piece.add', compact('titre', 'magasins', 'vehicules'));
    }

    public function store(Request $request)
    {
        $request->validate(Piece::RULES);
        $piece = new Piece($request->all());
        $piece->makeCode();
        if (!empty($request->vehicule)) {
            $piece->vehicule = $request->vehicule;
            $vehicule = Vehicule::find($request->vehicule);
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
        $piece->save();
        $message = "la piece $piece->nom a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function edit(int $id)
    {
        $piece = Piece::find($id);
        $magasins = Magasin::get();
        $titre = 'Modifier ' . $piece->code;
        return view('stock.piece.edit', compact('piece', 'magasins', 'titre'));
    }

    public function update(Request $request)
    {
        $piece = Piece::find($request->piece);
        $piece->prix_achat = $request->prix_achat;
        $piece->prix_vente = $request->prix_vente;
        $piece->emplacement = $request->emplacement;
        $piece->magasin = $request->magasin;
        $piece->save();
        $message = "la piece $piece->nom a été modifiée avec succès";
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
