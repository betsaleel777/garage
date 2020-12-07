<?php

namespace App\Http\Controllers\Maintenance\Essai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostessaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {

    }

    public function add()
    {
        $titre = 'Ajouter un essai';

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
