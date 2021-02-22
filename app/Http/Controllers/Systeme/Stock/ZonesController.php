<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Magasin;
use App\Models\Stock\Zone;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Toutes les Zones';
        $zones = Zone::get();
        return view('systeme.stock.magasin.zone.index', compact('titre', 'zones'));
    }

    public function add()
    {

    }

    public function store(Request $request)
    {

    }

    public function storeManuel(Request $request)
    {
        $request->validate(zone::RULES);
        $zone = new zone($request->all());
        $zone->save();
        $message = "la zone $zone->nom a été enregistré avec succès";
        session()->flash('success', $message);
        return response()->json(['id' => $zone->id]);

    }

    public function zonesOfmagasin(int $id)
    {
        $magasin = Magasin::with('zones')->find($id);
        $titre = 'Zones ' . $magasin->nom;
        return view('systeme.stock.magasin.zone.zonesof', compact('titre', 'magasin'));
    }

    public function plugZone(int $id)
    {
        $magasin = Magasin::find($id);
        $titre = 'Zone de ' . $magasin->nom;
        return view('systeme.stock.magasin.zone.plug', compact('magasin', 'titre'));
    }

    public function edit(int $id)
    {
        $zone = Zone::find($id);
        $titre = 'Modifier ' . $zone->nom;
        return view('systeme.stock.magasin.zone.edit', compact('zone', 'titre'));
    }

    public function editPlug(int $id)
    {
        $zone = Zone::with('magasinLinked')->find($id);
        $titre = 'Modifier ' . $zone->nom;
        return view('systeme.stock.magasin.zone.editplug', compact('zone', 'titre'));
    }

    public function update(Request $request)
    {
        $request->validate(Zone::regles($request->zone));
        $zone = Zone::find($request->zone);
        $zone->nom = $request->nom;
        $zone->identifiant = $request->identifiant;
        $zone->save();
        $message = "la zone a été modifiée avec succès";
        return redirect()->route('zones')->with('success', $message);
    }

    public function updatePlug(Request $request)
    {
        $request->validate(Zone::regles($request->zone));
        $zone = Zone::find($request->zone);
        $zone->nom = $request->nom;
        $zone->identifiant = $request->identifiant;
        $zone->save();
        $message = "la zone a été modifiée avec succès";
        return redirect()->route('zone_magasin', $zone->magasin)->with('success', $message);
    }
}
