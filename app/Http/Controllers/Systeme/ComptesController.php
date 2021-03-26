<?php

namespace App\Http\Controllers\Systeme;

use App\Http\Controllers\Controller;
use App\Models\User;

class ComptesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = "Comptes d'utilisateurs";
        $users = User::get();
        return view('systeme.compte.index', compact('titre', 'users'));
    }
}
