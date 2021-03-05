<?php

namespace App\Http\Controllers\Stock\Commande;

use App\Http\Controllers\Controller;
use App\Models\Finance\Commande\CommandeSimple;
use App\Models\Finance\Commande\MediaCommande;
use App\Models\Stock\Fournisseur;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommandesSimplesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function liste()
    {
        $titre = 'Commandes simples';
        $commandes = CommandeSimple::with('fournisseurLinked')->get();
        return view('stock.commande.simple.liste', compact('titre', 'commandes'));
    }

    public function add()
    {
        $titre = 'Créer une commande simple';
        $pieces = array_map(function ($piece) {
            return [
                'code' => $piece->id,
                'name' => $piece->reference . '.' . $piece->nom,
            ];
        }, Piece::get()->all());
        $fournisseurs = array_map(function ($fournisseur) {
            return [
                'code' => $fournisseur->id,
                'label' => $fournisseur->nom,
            ];
        }, Fournisseur::get()->all());
        $magasins = array_map(function ($magasin) {
            return [
                'code' => $magasin->id,
                'label' => $magasin->nom,
            ];
        }, Magasin::get()->all());
        return view('stock.commande.simple.add', compact('titre', 'fournisseurs', 'pieces', 'magasins'));
    }

    public function store(Request $request)
    {
        //création de la commande simple
        $request->validate(CommandeSimple::RULES);
        $commande = new CommandeSimple($request->all());
        $commande->user = session('user_id');
        $commande->enCours();
        $commande->genererCode();
        $commande->save();
        //associer les pieces à la commande qui vient d'être enregistrée
        $commande = CommandeSimple::find($commande->id);
        foreach ($request->pieces as $pieceJson) {
            $piece = json_decode($pieceJson);
            $commande->pieces()->attach($piece->code,
                [
                    'quantite' => (int) $piece->quantite,
                    'prix_achat' => (int) $piece->achat,
                    'prix_vente' => (int) $piece->vente,
                ]);
        }
        //créer les pieces jointes (document) si elles existent
        $medias = $request->medias;
        if (!empty($medias)) {
            foreach ($medias as $file) {
                $media = new MediaCommande();
                $media->user = session('user_id');
                $media->commande = $commande->id;
                $path = Storage::putFile('public/commandes_simples', $file);
                $media->media = Str::substr($path, 7);
                $media->save();
            }
        }
        $message = "la commande $commande->code a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }
}
