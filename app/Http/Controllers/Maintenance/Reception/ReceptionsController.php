<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reception\Reception;
use Illuminate\Http\Request;

class ReceptionsController extends Controller
{
    public function index()
    {
        $titre = 'Tableau des réceptions';
        return view('maintenance.reception.index', compact('titre'));
    }

    public function add()
    {
        $titre = 'Ajouter une réception';

    }

    public function liste()
    {
        $receptions = Reception::get();
        $titre = 'Liste Réception';
        return view('maintenance.reception.liste', compact('titre', 'receptions'));
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
