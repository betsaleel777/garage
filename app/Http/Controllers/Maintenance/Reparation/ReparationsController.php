<?php

namespace App\Http\Controllers\Maintenance\Reparation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReparationsController extends Controller
{
    public function index()
    {
        $titre = 'Réparations';

    }

    public function add()
    {
        $titre = 'Ajouter un réparation';

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
