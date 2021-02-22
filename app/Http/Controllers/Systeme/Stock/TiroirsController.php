<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Etagere;
use App\Models\Stock\Tiroir;
use Illuminate\Http\Request;

class TiroirsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function tiroirsOfetagere(int $id)
    {
        $etagere = Etagere::with('zoneLinked', 'tiroirs')->find($id);
        $titre = 'tiroirs ' . $etagere->nom;
        return view('systeme.stock.magasin.tiroir.tiroirsof', compact('titre', 'etagere'));
    }

    public function plugTiroir(int $id)
    {
        $etagere = Etagere::find($id);
        $titre = 'Tiroir de ' . $etagere->nom;
        return view('systeme.stock.magasin.tiroir.plug', compact('etagere', 'titre'));
    }

    public function storeManuel(Request $request)
    {
        $request->validate(Tiroir::RULES);
        $tiroir = new Tiroir($request->all());
        $tiroir->save();
        $message = "le tiroir $tiroir->nom a été enregistré avec succès";
        session()->flash('success', $message);
        return response()->json(['id' => $tiroir->id]);
    }

    public function editPlug(int $id)
    {
        $tiroir = Tiroir::with('etagereLinked.zoneLinked.magasinLinked')->find($id);
        $titre = 'Modifier ' . $tiroir->nom;
        return view('systeme.stock.magasin.tiroir.editplug', compact('tiroir', 'titre'));
    }

    public function update(Request $request)
    {
        $request->validate(Tiroir::regles($request->tiroir));
        $tiroir = Tiroir::find($request->tiroir);
        $tiroir->nom = $request->nom;
        $tiroir->identifiant = $request->identifiant;
        $tiroir->save();
        $message = "le tiroir a été modifié avec succès";
        return redirect()->route('tiroirs')->with('success', $message);
    }

    public function updatePlug(Request $request)
    {
        $request->validate(Tiroir::regles($request->tiroir));
        $tiroir = Tiroir::find($request->tiroir);
        $tiroir->nom = $request->nom;
        $tiroir->identifiant = $request->identifiant;
        $tiroir->save();
        $message = "le tiroir a été modifié avec succès";
        return redirect()->route('tiroir_etagere', $tiroir->etagere)->with('success', $message);
    }
}
