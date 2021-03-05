<?php

namespace App\Http\Controllers\Finance\Commande;

use App\Http\Controllers\Controller;
use App\Models\Finance\Commande\CommandeSimple;
use App\Models\Stock\Fournisseur;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use Illuminate\Http\Request;

class CommandesSimplesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {
        $titre = 'Commandes simples';
        $commandes = CommandeSimple::with('fournisseurLinked')->get();
        return view('finance.commande.simple.liste', compact('titre', 'commandes'));
    }

    public function add()
    {
        $titre = 'Créer une commande simple';
        $titre = 'Créer une commande simple';
        $pieces = array_map(function ($piece) {
            return [
                'code' => $piece->id,
                'name' => $piece->reference . '.' . $piece->nom,
            ];
        }, Piece::get()->all());
        $fournisseurs = array_map(function ($fournisseur) {
            return [
                'code' => $fournisseur->id,
                'label' => $fournisseur->nom,
            ];
        }, Fournisseur::get()->all());
        $magasins = array_map(function ($magasin) {
            return [
                'code' => $magasin->id,
                'label' => $magasin->nom,
            ];
        }, Magasin::get()->all());
        return view('finance.commande.simple.add', compact('titre', 'fournisseurs', 'pieces', 'magasins'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        return response()->json([$request->all()]);
    }
}
