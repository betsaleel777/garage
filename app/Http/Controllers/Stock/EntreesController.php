<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Entree;
use Illuminate\Http\Request;

class EntreesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entrees = Entree::with('utilisateur')->get();
        $titre = 'Entrées en stock';
        return view('systeme.stock.entree.index', compact('titre', 'entrees'));
    }

    public function store(Request $request)
    {

    }

    function print(int $id) {

    }

    public function delete(int $id)
    {
        $entree = Entree::find($id);
        $entree->delete();
        $message = "l'approvisionnement $entree->code a été supprimé avec succès.";
        session()->flash('success', $message);
        return;
    }
}
