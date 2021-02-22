<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Etagere;
use App\Models\Stock\Zone;
use Illuminate\Http\Request;

class EtageresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Toutes les étagères';
        $etageres = Etagere::get();
        return view('systeme.stock.magasin.zone.index', compact('titre', 'etageres'));
    }

    public function etageresOfzone(int $id)
    {
        $zone = Zone::with('etageres')->find($id);
        $titre = 'Etageres ' . $zone->nom;
        return view('systeme.stock.magasin.etagere.etageresof', compact('titre', 'zone'));
    }

    public function storeManuel(Request $request)
    {
        $request->validate(Etagere::RULES);
        $etagere = new Etagere($request->all());
        $etagere->save();
        $message = "l'étagère $etagere->nom a été enregistrée avec succès";
        session()->flash('success', $message);
        return response()->json(['id' => $etagere->id]);
    }

    public function plugEtagere(int $id)
    {
        $zone = Zone::find($id);
        $titre = 'Etagère de ' . $zone->nom;
        return view('systeme.stock.magasin.etagere.plug', compact('zone', 'titre'));
    }

    public function editPlug(int $id)
    {
        $etagere = Etagere::with('zoneLinked.magasinLinked')->find($id);
        $titre = 'Modifier ' . $etagere->nom;
        return view('systeme.stock.magasin.etagere.editplug', compact('etagere', 'titre'));
    }

    public function update(Request $request)
    {
        $request->validate(Etagere::regles($request->etagere));
        $etagere = Etagere::find($request->etagere);
        $etagere->nom = $request->nom;
        $etagere->identifiant = $request->identifiant;
        $etagere->save();
        $message = "l'étagère a été modifiée avec succès";
        return redirect()->route('etageres')->with('success', $message);
    }

    public function updatePlug(Request $request)
    {
        $request->validate(Etagere::regles($request->etagere));
        $etagere = Etagere::find($request->etagere);
        $etagere->nom = $request->nom;
        $etagere->identifiant = $request->identifiant;
        $etagere->save();
        $message = "l'étagère a été modifiée avec succès";
        return redirect()->route('etagere_zone', $etagere->zone)->with('success', $message);
    }
}
