<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etagere extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'zone'];

    public function zoneLinked()
    {
        return $this->belongsTo(Zone::class, 'zone');
    }

    public function tiroirs()
    {
        return $this->hasMany(Tiroir::class, 'etagere');
    }
}
