<?php

namespace App\Http\Controllers\Finance\Commande;

use App\Http\Controllers\Controller;

class CommandesReparationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {

    }
}
