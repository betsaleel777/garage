<?php

namespace App\Http\Controllers\Systeme;

use App\Http\Controllers\Controller;
use App\Models\Systeme\TypesReparation;
use Illuminate\Http\Request;

class TypesReparationsController extends Controller
{
    public function index()
    {
        $titre = 'Types réparations';
        $types = TypesReparation::orderBy('surcusale')->get();
        return view('systeme.type_reparation.index', compact('titre', 'types'));
    }

    public function add()
    {
        $titre = 'Nouveau type de réparation';
        return view('systeme.type_reparation.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(TypesReparation::RULES);
        TypesReparation::create($request->all());
        $message = "le type de réparation nommé $request->nom a été enregistré avec succès";
        return redirect()->route('types_reparations')->with('success', $message)->withErrors($request->all());
    }

    public function edit(int $id)
    {
        $type = TypesReparation::find($id);
        $titre = 'Modifier ' . $type->nom;
        return view('systeme.type_reparation.edit', compact('titre', 'type'));
    }

    public function update(Request $request)
    {
        $type = TypesReparation::find($request->type);
        $request->validate(TypesReparation::RULES);
        $type->nom = $request->nom;
        $type->prix_forfaitaire = $request->prix_forfaitaire;
        $type->save();
        $message = 'Modification éffectuée avec succès';
        return redirect()->route('types_reparations')->with('success', $message)->withErrors($request->all());
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
