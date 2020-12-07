<?php

namespace App\Http\Controllers\Maintenance\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HangarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Hangars';

    }

    public function add()
    {
        $titre = 'Ajouter un hangar';

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
