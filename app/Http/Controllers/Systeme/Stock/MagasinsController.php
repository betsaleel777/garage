<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Magasin;
use Illuminate\Http\Request;

class MagasinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Magasins';
        $magasins = Magasin::orderBy('id', 'DESC')->get();
        return view('systeme.stock.magasin.index', compact('titre', 'magasins'));
    }

    public function add()
    {
        $titre = 'Nouveau Magasin';
        return view('systeme.stock.magasin.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Magasin::RULES);
        $magasin = new Magasin($request->all());
        $magasin->user = session('user_id');
        $magasin->save();
        $message = "le magasin $request->nom a été enregistré avec succès";
        return redirect()->route('magasins')->with('success', $message);
    }

    public function edit(int $id)
    {
        $magasin = Magasin::find($id);
        $titre = 'Modifier ' . $magasin->nom;
        return view('systeme.stock.magasin.edit', compact('titre', 'magasin'));
    }

    public function update(Request $request)
    {
        $request->validate(Magasin::regles($request->magasin));
        Magasin::where('id', $request->magasin)->update($request->except('magasin', '_token'));
        $message = "la modification du magasin a été effectuée avec succès";
        return redirect()->route('magasins')->with('success', $message);
    }
}
