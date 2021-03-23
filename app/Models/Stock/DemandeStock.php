<?php

namespace App\Models\Stock;

use App\Models\Finance\Commande\CommandeSimple;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DemandeStock extends Model
{

    protected $fillable = ['code', 'motif', 'urgence', 'nom', 'destinataire', 'user', 'reparation', 'magasin'];
    protected $table = 'demandes_stock';
    protected $dates = ['created_at'];

    const RULES = [
        'motif' => 'required',
        'urgence' => 'required',
        'destinataire' => 'required',
    ];
    const TO_SUPPLIER = 'fournisseur';
    const TO_WHAREHOUSE = 'magasin';
    const URGENCE_MAXIMALE = 'maximale';
    const URGENCE_NORMALE = 'normale';
    const URGENCE_ELEVEE = 'elévée';
    const URGENCE_FAIBLE = 'faible';

    public function totalementTraitee()
    {
        $found = false;
        $commandes = $this->commandes()->get();
        foreach ($commandes as $commande) {
            if ($commande->estEnCours()) {
                $found = true;
                break;
            }
        }
        return !$found;
    }

    public function urgenceMaximale()
    {
        return $this->attributes['urgence'] === self::URGENCE_MAXIMALE;
    }

    public function urgenceNormale()
    {
        return $this->attributes['urgence'] === self::URGENCE_NORMALE;
    }

    public function urgenceFaible()
    {
        return $this->attributes['urgence'] === self::URGENCE_FAIBLE;
    }

    public function urgenceElevee()
    {
        return $this->attributes['urgence'] === self::URGENCE_ELEVEE;
    }

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

    public function commandes()
    {
        return $this->hasMany(CommandeSimple::class, 'demande');
    }

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'pieces_demandes_stock', 'demande', 'piece')->using(PieceDemande::class)
            ->withPivot('quantite', 'vehicule')
            ->withTimestamps();
    }

}
