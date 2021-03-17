<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'lieu', 'user'];

    const RULES = [
        'nom' => 'required|unique:magasins,nom',
        'lieu' => 'required',
    ];

    public static function regles(int $id)
    {
        return [
            'nom' => 'required|unique:magasins,nom,' . $id,
            'lieu' => 'required',
        ];
    }

    public function zones()
    {
        return $this->hasMany(Zone::class, 'magasin');
    }

    public function etageres()
    {
        return $this->hasMany(Etagere::class, 'magasin');
    }

    public function demandes()
    {
        return $this->hasMany(DemandeStock::class, 'magasin');
    }
}
