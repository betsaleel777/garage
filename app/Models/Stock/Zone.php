<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'magasin'];

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }
    public function etageres()
    {
        return $this->hasMany(Etagere::class, 'zone');
    }
}
