<?php

namespace App\Models\Stock;

use App\Models\Finance\Commande\CommandeSimple;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeStock extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'motif', 'urgence', 'nom', 'destinataire', 'user', 'reparation', 'magasin'];
    protected $table = 'demandes_stock';

    const RULES = [
        'motif' => 'required',
        'urgence' => 'required',
        'destinataire' => 'required',
    ];
    const TO_SUPPLIER = 'fournisseur';
    const TO_WHAREHOUSE = 'magasin';
    const URGENCE_MAX = 'maximale';
    const URGENT = 'normale';
    const TRES_URGENT = 'elévée';
    const PEU_URGENT = 'faible';

    public function genererCode(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'DEMM' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function commandeSimples()
    {
        return $this->hasMany(CommandeSimple::class, 'demande');
    }

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'pieces_demandes_stock', 'demande', 'piece')->withPivot('quantite')->withTimestamps();
    }

}
