<?php

namespace App\Http\Controllers\Stock\Commande;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandesReparationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {

    }

    public function store(Request $request)
    {

    }
}
