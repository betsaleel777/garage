<?php

namespace App\Http\Controllers\Stock\Commande;

use App\Http\Controllers\Controller;
use App\Models\Finance\Commande\CommandeSimple;
use App\Models\Finance\Commande\MediaCommande;
use App\Models\Stock\DemandeStock;
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
        $demandes = DemandeStock::with('commandes')->get();
        $commandes = CommandeSimple::with('utilisateur', 'fournisseurLinked', 'magasinLinked')->doesntHave('demandeLinked')->get();
        return view('stock.commande.simple.liste', compact('titre', 'demandes', 'commandes'));
    }

    private static function prepareForm()
    {
        foreach (Piece::with('vehicules')->get()->all() as $piece) {
            foreach ($piece->vehicules as $vehicule) {
                $pieces[] = [
                    'code' => $piece->id,
                    'name' => $piece->reference . '.' . $piece->nom . " ($vehicule->designation)",
                    'vehicule' => $vehicule->id,
                ];
            }
        }
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
        return ['pieces' => $pieces, 'magasins' => $magasins, 'fournisseurs' => $fournisseurs];
    }

    private static function mediaStorage($medias, $commande)
    {
        if (!empty($medias)) {
            foreach ($medias as $file) {
                $media = new MediaCommande();
                $media->user = session('user_id');
                $media->commande = $commande;
                $path = Storage::putFile('public/commandes_simples', $file);
                $media->media = Str::substr($path, 7);
                $media->save();
            }
        }
    }

    public function add()
    {
        $titre = 'Créer une commande simple';
        ['fournisseurs' => $fournisseurs, 'magasins' => $magasins, 'pieces' => $pieces] = self::prepareForm();
        return view('stock.commande.simple.add', compact('titre', 'fournisseurs', 'pieces', 'magasins'));
    }

    public function plug(int $demande)
    {
        $titre = 'Créer une commande simple';
        $demande = DemandeStock::with('pieces', 'commandes')->find($demande);
        ['fournisseurs' => $fournisseurs, 'magasins' => $magasins, 'pieces' => $pieces] = self::prepareForm();
        return view('stock.commande.simple.plug', compact('titre', 'fournisseurs', 'pieces', 'magasins', 'demande'));
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
                    'vehicule' => (int) $piece->vehicule,
                ]);
        }
        //créer les pieces jointes (document) si elles existent
        self::mediaStorage($request->medias, $commande->id);
        $message = "la commande $commande->code a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function storePlug(Request $request)
    {
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
            $commande->pieces()->attach($piece->id,
                [
                    'quantite' => (int) $piece->quantite,
                    'prix_achat' => (int) $piece->achat,
                    'prix_vente' => (int) $piece->vente,
                    'vehicule' => (int) $piece->vehicule,
                ]);
        }
        //créer les pieces jointes (document) si elles existent
        self::mediaStorage($request->medias, $commande->id);
        $message = "la commande $commande->code a été enregistrée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function edit(int $id)
    {
        $commande = CommandeSimple::with('pieces', 'medias')->find($id);
        $titre = 'Modifier commande ' . $commande->code;
        ['fournisseurs' => $fournisseurs, 'magasins' => $magasins, 'pieces' => $pieces] = self::prepareForm();
        return view('stock.commande.simple.edit', compact('titre', 'pieces', 'magasins', 'fournisseurs', 'commande'));
    }

    public function delete(int $id)
    {
        $commande = CommandeSimple::find($id);
        $commande->delete();
        $message = "la commande $commande->code a été supprimé avec succes";
        session()->flash('success', $message);
        return response()->json(['message' => $message]);
    }

    public function update(Request $request)
    {
        $request->validate(CommandeSimple::EDIT_RULES);
        $commande = CommandeSimple::find($request->commande);
        $commande->fournisseur = $request->fournisseur;
        $commande->magasin = $request->magasin;
        $commande->save();
        //associer les pieces à la commande qui vient d'être enregistrée
        $arraySync = [];
        foreach ($request->pieces as $pieceJson) {
            $piece = json_decode($pieceJson);
            $arraySync = array_merge($arraySync, [$piece->code,
                [
                    'quantite' => (int) $piece->quantite,
                    'prix_achat' => (int) $piece->achat,
                    'prix_vente' => (int) $piece->vente,
                ]]);
        }
        //créer les pieces jointes (document) si elles existent
        //self::mediaStorage();
        $message = "la commande $commande->code a été modifiée avec succès";
        session()->flash('success', $message);
    }

    public function show(int $id)
    {

    }
}
