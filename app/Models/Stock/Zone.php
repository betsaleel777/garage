<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'magasin'];

    const RULES = [
        'nom' => 'required|unique:zones,nom',
        'identifiant' => 'required|unique:zones,identifiant',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:zones,nom,' . $id,
            'identifiant' => 'required|unique:zones,identifiant,' . $id,
        ];
    }

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }
    public function etageres()
    {
        return $this->hasMany(Etagere::class, 'zone');
    }
}
