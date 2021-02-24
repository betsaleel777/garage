<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;

class FinancesController extends Controller
{
    public function index()
    {
        $titre = 'Acceuil finance';
        return view('finance.index', compact('titre'));
    }
}
