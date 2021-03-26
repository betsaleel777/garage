<?php

namespace App\Models\Finance\Commande;

use App\Models\Finance\PieceCommande;
use App\Models\Stock\DemandeStock;
use App\Models\Stock\Fournisseur;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeSimple extends Model
{
    use HasFactory;
    protected $fillable = ['notes', 'status', 'magasin', 'user', 'reference', 'code', 'fournisseur', 'demande'];
    protected $table = 'commandes_simples';
    protected $dates = ['created_at'];

    public function genererCode(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'SCOM' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    const EN_COURS = 'en cours';
    const ANNULEE = 'annulée';
    const LIVREE = 'livrée';

    const RULES = [
        'magasin' => 'required',
        'reference' => 'required',
        'fournisseur' => 'required',
    ];

    const EDIT_RULES = [
        'magasin' => 'required',
        'fournisseur' => 'required',
    ];

    public function enCours()
    {
        $this->attributes['status'] = self::EN_COURS;
    }

    public function estEnCours()
    {
        return $this->attributes['status'] === self::EN_COURS;
    }

    public function annulee()
    {
        $this->attributes['status'] = self::ANNULEE;
    }

    public function estAnnulee()
    {
        return $this->attributes['status'] === self::ANNULEE;
    }

    public function livree()
    {
        $this->attributes['status'] = self::LIVREE;
    }

    public function estLivree()
    {
        return $this->attributes['status'] === self::LIVREE;
    }

    //vérifier si la quantité demandée pour chaque piece a été commandée
    public function estHonoree()
    {
        $honoree = true;
        $commande = $this->with('demandeLinked.pieces.pivot.vehiculeLinked', 'pieces.pivot.vehiculeLinked')->get();
        if (empty($commande->demandeLinked)) {
            return;
        } else {
            $piecesDemandees = $commande->demandeLinked->pieces;
            $piecesCommandees = $commande->pieces;
            foreach ($piecesDemandees as $pieceDem) {
                $totalCommandees = 0;
                foreach ($piecesCommandees as $pieceCom) {
                    if (($pieceDem->id === $pieceCom->id) and ($pieceDem->pivot->vehiculeLinked->id === $pieceCom->pivot->vehiculeLinked->id)) {
                        $totalCommandees += $pieceCom->pivot->quantite;
                    }
                }
                if ($totalCommandees < $pieceDem->pivot->quantite) {
                    $honoree = false;
                    break;
                }
            }
        }
        return $honoree;
    }

    public function livrable()
    {
        if ($this->estHonoree()) {
            $this->livree();
        }
    }

    public function medias()
    {
        return $this->hasMany(MediaCommande::class, 'commande');
    }

    public function demandeLinked()
    {
        return $this->belongsTo(DemandeStock::class, 'demande');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }

    public function fournisseurLinked()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur');
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'pieces_commandes_simples', 'commande', 'piece')->using(PieceCommande::class)
            ->withPivot('quantite', 'prix_achat', 'prix_vente', 'vehicule')
            ->withTimestamps();
    }
}
