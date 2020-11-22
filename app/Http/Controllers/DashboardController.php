<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Tableau de bord';
        return view('dashboard', compact('titre'));
    }

    public function maintenance()
    {
        $titre = 'Maintenance Acceuil';
        return view('maintenance.index', compact('titre'));
    }

    public function crm()
    {
        $titre = 'CRM Acceuil';

    }

    public function stock()
    {
        $titre = 'Stock Acceuil';

    }

    public function finance()
    {
        $titre = 'Finance Acceuil';
    }

    public function systeme()
    {
        $titre = 'Acceuil Système';
    }
}
