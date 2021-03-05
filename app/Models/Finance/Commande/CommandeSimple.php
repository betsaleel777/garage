<?php

namespace App\Models\Finance\Commande;

use App\Models\Stock\Fournisseur;
use App\Models\Stock\Magasin;
use App\Models\Stock\Piece;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeSimple extends Model
{
    use HasFactory;
    protected $fillable = ['notes', 'status', 'magasin', 'user', 'reference', 'code', 'fournisseur'];
    protected $table = 'commandes_simples';

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

    public function enCours()
    {
        $this->attributes['status'] = self::EN_COURS;
    }

    public function annulee()
    {
        $this->attributes['status'] = self::ANNULEE;
    }

    public function livree()
    {
        $this->attributes['status'] = self::LIVREE;
    }

    public function medias()
    {
        return $this->hasMany(MediaCommande::class, 'commande');
    }

    public function utilisateur()
    {
        return $this->hasOne(User::class, 'user');
    }

    public function magasinLinked()
    {
        return $this->hasOne(Magasin::class, 'magasin');
    }

    public function fournisseurLinked()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur');
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'pieces_commandes_simples', 'commande', 'piece')
            ->withPivot('quantite', 'prix_achat', 'prix_vente')
            ->withTimestamps();
    }
}
