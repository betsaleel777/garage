<?php

namespace App\Models\Stock;

use App\Models\Systeme\Vehicule;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PieceDemande extends Pivot
{
    protected $fillable = ['demande', 'piece', 'quantite', 'vehicule'];
    public $incrementing = true;

    public function vehiculeLinked()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule');
    }
}
