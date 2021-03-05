<?php

namespace App\Http\Controllers\Finance\Commande;

use App\Http\Controllers\Controller;

class CommandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Acceuil commandes';
        return view('finance.commande.index', compact('titre'));
    }
}
