<?php

namespace App\Http\Controllers\Stock\Commande;

use App\Http\Controllers\Controller;
use App\Models\Finance\Commande\CommandeSimple;
use App\Models\Stock\Fournisseur;
use App\Models\Stock\Piece;
use Illuminate\Http\Request;

class CommandesSimplesController extends Controller
{
    public function liste()
    {
        $titre = 'Commandes simples';
        $commandes = CommandeSimple::with('fournisseurLinked')->get();
        return view('stock.commande.simple.liste', compact('titre', 'commandes'));
    }

    public function add()
    {
        $titre = 'Créer une commande simple';
        $pieces = Piece::get();
        $fournisseurs = Fournisseur::get();
        return view('stock.commande.simple.add', compact('titre', 'fournisseurs', 'pieces'));
    }

    public function store(Request $request)
    {

    }
}
