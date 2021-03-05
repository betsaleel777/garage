<?php

namespace App\Http\Controllers\Stock\Commande;

use App\Http\Controllers\Controller;

class CommandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Commandes';
        return view('stock.commande.index', compact('titre'));
    }

}
