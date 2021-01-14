<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Piece;
use Illuminate\Http\Request;

class PiecesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {
        $titre = 'Pieces';
        $pieces = Piece::with('categorielinked')->get();
        return view('stock.piece.liste', compact('pieces', 'titre'));
    }

    public function add()
    {

    }

    public function store(Request $request)
    {

    }
}
