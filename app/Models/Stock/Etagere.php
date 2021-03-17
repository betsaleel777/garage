<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etagere extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'zone'];

    const RULES = [
        'nom' => 'required|unique:etageres,nom',
        'identifiant' => 'required|unique:etageres,identifiant',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:etageres,nom,' . $id,
            'identifiant' => 'required|unique:etageres,identifiant,' . $id,
        ];
    }

    public function magasinLinked()
    {
        return $this->belongsTo(Magasin::class, 'magasin');
    }

    public function zoneLinked()
    {
        return $this->belongsTo(Zone::class, 'zone');
    }

    public function tiroirs()
    {
        return $this->hasMany(Tiroir::class, 'etagere');
    }
}
