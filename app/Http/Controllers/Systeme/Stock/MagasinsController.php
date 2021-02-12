<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Etagere;
use App\Models\Stock\Magasin;
use App\Models\Stock\Tiroir;
use App\Models\Stock\Zone;
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

    public function storejs(Request $request)
    {
        //creation du magasin
        $magasin = new Magasin($request->magasin);
        $magasin->user = session('user_id');
        $magasin->save();
        //creation des zones
        $zones = $request->zones;
        if (!empty($zones)) {
            foreach ($zones as $zoneData) {
                $zone = new Zone($zoneData);
                $zone->magasin = $magasin->id;
                $zone->save();
            }
            //creation des étagères avec les zones
            $etageresZone = $request->etageres;
            foreach ($etageresZone as $key => $etageres) {
                $zone = Zone::where('identifiant', $key)->get()->first();
                foreach ($etageres as $etagereData) {
                    $etagere = new Etagere($etagereData);
                    $etagere->zone = $zone->id;
                    $etagere->save();
                }
            }
        } else {
            $etageres = $request->etageres;
            foreach ($etageres as $etagereData) {
                $etagere = new Etagere($etagereData);
                $etagere->save();
            }
        }
        //creation des tiroirs
        $tiroirsEtagere = $request->tiroirs;
        foreach ($tiroirsEtagere as $key => $tiroirs) {
            $etagere = Etagere::where('identifiant', $key)->get()->first();
            foreach ($tiroirs as $tiroirData) {
                $tiroir = new Tiroir();
                $tiroir->nom = $tiroirData['name'];
                $tiroir->identifiant = $tiroirData['id'];
                $tiroir->etagere = $etagere->id;
                $tiroir->save();
            }
        }
        return;
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
