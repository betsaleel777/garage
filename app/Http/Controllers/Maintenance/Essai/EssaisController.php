<?php

namespace App\Http\Controllers\Maintenance\Essai;

use App\Http\Controllers\Controller;

class EssaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Tableau des Essais';
        return view('maintenance.essais.index', compact('titre'));
    }
}
