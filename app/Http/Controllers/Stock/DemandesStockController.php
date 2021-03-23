<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Reparation\Reparation;
use App\Models\Stock\DemandeStock;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DemandesStockController extends Controller
{
    public function index()
    {
        $titre = 'Demandes du stock';
        $demandes = DemandeStock::with('utilisateur')->get();
        return view('stock.demande.index', compact('titre', 'demandes'));
    }

    public function add()
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
        $magasins = array_map(function ($magasin) {
            return [
                'code' => $magasin->id,
                'label' => $magasin->nom,
            ];
        }, Magasin::get()->all());
        $reparations = array_map(function ($reparation) {
            return [
                'code' => $reparation->id,
                'name' => $reparation->code,
            ];
        }, Reparation::get()->all());
        $titre = 'Créer une demande';
        return view('stock.demande.add', compact('pieces', 'titre', 'reparations', 'magasins'));
    }

    public function store(Request $request)
    {
        //validité des données
        $rules = [];
        if (!empty($request->destinataire) and $request->destinataire === 'magasin') {
            $rules = array_merge($rules, ['magasin' => 'required']);
        }
        if (!empty($request->motif) and $request->motif === 'reparation') {
            $rules = array_merge($rules, ['reparation' => 'required']);
        }
        $rules = array_merge($rules, DemandeStock::RULES);
        $request->validate($rules);
        //création de la demande
        $demande = new DemandeStock($request->all());
        $demande->user = session('user_id');
        $demande->genererCode();
        $demande->save();
        $demande = DemandeStock::find($demande->id);
        foreach ($request->pieces as $piece) {
            $demande->pieces()->attach($piece['code'], ['quantite' => $piece['quantite'], 'vehicule' => $piece['vehicule']]);
        }
        $message = "la demande $demande->code a été crée avec succès.";
        session()->flash('success', $message);
        return;
    }

    public function show(int $id)
    {
        $demande = DemandeStock::with('commandes.pieces', 'utilisateur', 'pieces.pivot.vehiculeLinked', 'pieces.categorieEnfant')->find($id);
        $titre = 'Demande ' . $demande->code;
        return view('stock.demande.show', compact('titre', 'demande'));
    }

    public function delete(int $id)
    {
        $demande = DemandeStock::find($id);
        $demande->delete();
        $message = "la Demande $demande->code a été supprimée avec succès.";
        session()->flash('success', $message);
        return;
    }
    //retourne pour chaque pieces de la demande en stock la quantité dejà commandée qui correspond
    public function dejaCommande(int $demande)
    {
        $demande = DemandeStock::with('commandes.pieces')->find($demande);
        $quantitePiece = new Collection();
        foreach ($demande->commandes as $commande) {
            if ($commande->estEnCours()) {
                foreach ($commande->pieces as $piece) {
                    $quantitePiece->push(['id' => $piece->id, 'quantite' => $piece->pivot->quantite, 'vehicule' => $piece->pivot->vehicule]);
                }
            }
        }
        $quantitePiece = $quantitePiece->groupBy(['id', 'vehicule']);
        $dejaCommande = [];
        foreach ($quantitePiece as $id => $lignes) {
            foreach ($lignes as $vehicule => $rows) {
                $quantite = 0;
                foreach ($rows as $value) {
                    $quantite += $value['quantite'];
                }
                $dejaCommande = array_merge($dejaCommande, [$id . '-' . $vehicule => $quantite]);
            }
        }
        return response()->json(['deja' => $dejaCommande]);
    }
}
