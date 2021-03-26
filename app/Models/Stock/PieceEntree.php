<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PieceEntree extends Pivot
{
    protected $fillable = ['entree', 'piece', 'quantite', 'vehicule'];
    public $incrementing = true;

    public function vehiculeLinked()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule');
    }
}
