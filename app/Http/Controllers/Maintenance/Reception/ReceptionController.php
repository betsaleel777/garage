<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function index()
    {
        $titre = 'Receptions';

    }

    public function add()
    {
        $titre = 'Ajouter un réception';

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
