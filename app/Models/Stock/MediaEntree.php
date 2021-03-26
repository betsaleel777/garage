<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class MediaEntree extends Model
{
    protected $fillable = ['entree', 'media'];

    public function entreeLinked()
    {
        return $this->belongsTo(Entree::class, 'entree');
    }
}
