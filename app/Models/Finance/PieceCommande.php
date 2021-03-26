<?php

namespace App\Models\Finance;

use App\Models\Systeme\Vehicule;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PieceCommande extends Pivot
{
    protected $fillable = ['commande', 'piece', 'quantite', 'vehicule', 'prix_achat', 'prix_vente'];
    protected $table = 'pieces_commandes_simples';
    public $incrementing = true;

    public function vehiculeLinked()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule');
    }
}
