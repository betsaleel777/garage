<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\Fabricant;
use App\Models\Stock\Piece;
use App\Models\Stock\SousCategorie;
use App\Models\Stock\Tiroir;
use App\Models\Systeme\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PiecesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private static function getEmplacements(): array
    {
        $tiroirs = Tiroir::with('etagereLinked.zoneLinked.magasinLinked')->get();
        $emplacements = array_map(function ($tiroir) {
            $labelMagasin = empty($tiroir->etagereLinked->zoneLinked?->magasinLinked->nom) ? $labelMagasin = $tiroir->etagereLinked->magasinLinked->nom : $labelMagasin = $tiroir->etagereLinked->zoneLinked?->magasinLinked->nom;
            $label = $tiroir->nom
            . '-' . $tiroir->etagereLinked->identifiant
            . '-' . $tiroir->etagereLinked->zoneLinked?->identifiant
                . '-' . $labelMagasin;
            return ['label' => $label, 'code' => $tiroir->id];
        }, $tiroirs->all());
        return $emplacements;
    }

    public function liste()
    {
        $titre = 'Pieces';
        $pieces = Piece::with('categorielinked')->get();
        return view('stock.piece.liste', compact('pieces', 'titre'));
    }

    public function add()
    {
        $titre = 'Nouvelle pièce';
        $data = Fabricant::get()->all();
        $fabricants = array_map(function ($fabricant) {
            return ['label' => $fabricant->nom, 'code' => $fabricant->id];
        }, $data);
        $data = Vehicule::get()->all();
        $vehicules = array_map(function ($vehicule) {
            return ['label' => $vehicule->designation, 'code' => $vehicule->id];
        }, $data);
        $emplacements = self::getEmplacements();
        return view('stock.piece.add', compact('titre', 'fabricants', 'vehicules', 'emplacements'));
    }

    public function store(Request $request)
    {
        $request->validate(Piece::RULES);
        $piece = new Piece($request->all());
        $piece->genererCode();
        $scategorie = SousCategorie::find($request->sous_categorie);
        $piece->makeName($scategorie->slug, $piece->etat_piece, $piece->type_piece);
        $piece->user = session('user_id');
        //upload of image
        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/pieces', $request->file('image'));
            $piece->image = Str::substr($path, 7);
        }
        $piece->save();
        $piece = Piece::find($piece->id);
        $piece->vehicules()->attach($request->vehicules);
        $message = "la piece $piece->reference a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function edit(int $id)
    {
        $piece = Piece::with(['categorieLinked' => function ($query) {
            $query->select('id', 'nom', 'image');
        }, 'categorieEnfant' => function ($query) {
            $query->select('id', 'nom');
        }])->find($id);
        $emplacements = self::getEmplacements();
        $titre = 'Modifier ' . $piece->code;
        return view('stock.piece.edit', compact('piece', 'titre', 'emplacements'));
    }

    public function update(Request $request)
    {
        $piece = Piece::find($request->piece);
        $piece->description = $request->description;
        $piece->emplacement = $request->emplacement;
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $piece->image);
            $path = Storage::putFile('public/pieces', $request->file('image'));
            $piece->image = Str::substr($path, 7);
        }
        $piece->save();
        $message = "la piece $piece->reference a été modifiée avec succès";
        return redirect()->route('pieces')->with('success', $message);
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function forceDelete(int $id)
    {

    }
}
