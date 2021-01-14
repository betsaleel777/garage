<?php

namespace App\Http\Controllers\Systeme\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Fabricant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FabricantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $titre = 'Fabricants de pièces';
        $fabricants = Fabricant::orderBy('id', 'DESC')->get();
        return view('systeme.stock.fabricant.index', compact('titre', 'fabricants'));
    }

    public function add()
    {
        $titre = 'Nouveau fabricant';
        return view('systeme.stock.fabricant.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Fabricant::RULES);
        $fabricant = new Fabricant($request->all());
        if ($request->hasFile('logo')) {
            $path = Storage::putFile('public/fabricants', $request->file('logo'));
            $fabricant->logo = Str::substr($path, 7);
        }
        $fabricant->user = session('user_id');
        $fabricant->save();
        $message = "le fabricant $fabricant->name a été enregistré avec succès.";
        return redirect()->route('fabricants')->with('success', $message);
    }

    public function edit(int $id)
    {
        $fabricant = Fabricant::find($id);
        $titre = 'Modifier ' . $fabricant->nom;
        return view('systeme.stock.fabricant.edit', compact('titre', 'fabricant'));
    }

    public function update(Request $request)
    {
        $request->validate(Fabricant::regles($request->fabricant));
        $fabricant = Fabricant::find($request->fabricant);
        if ($request->hasFile('logo')) {
            //delete old logo
            Storage::delete('public/' . $fabricant->logo);
            $path = Storage::putFile('public/fabricants', $request->file('logo'));
            $fabricant->logo = Str::substr($path, 7);
        }
        $fabricant->nom = $request->nom;
        $fabricant->save();
        $message = "la modification du fabricant a été effectuée avec succès";
        return redirect()->route('fabricants')->with('success', $message);
    }

}
