<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiroir extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'etagere'];

    public function etagereLinked()
    {
        return $this->belongsTo(Etagere::class, 'etagere');
    }
}
