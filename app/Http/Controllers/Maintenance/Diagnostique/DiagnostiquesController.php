<?php

namespace App\Http\Controllers\Maintenance\Diagnostique;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Diagnostique\Diagnostique;
use Illuminate\Http\Request;

class DiagnostiquesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Tableau de Diagnostique';
        return view('maintenance.diagnostique.index', compact('titre'));
    }

    public function liste()
    {
        $diagnostiques = Diagnostique::get();
        $titre = 'Diagnostiques';
        return view('maintenance.diagnostique.liste', compact('diagnostiques', 'titre'));
    }

    public function add()
    {
        $titre = 'Ajouter un diagnostique';

    }

    public function store(Request $request)
    {

    }

    public function edit()
    {
        $titre = '';
    }

    public function update(Request $request)
    {

    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
