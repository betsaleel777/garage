<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiroir extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'identifiant', 'etagere'];

    const RULES = [
        'nom' => 'required|unique:tiroirs,nom',
        'identifiant' => 'required|unique:tiroirs,identifiant',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:tiroirs,nom,' . $id,
            'identifiant' => 'required|unique:tiroirs,identifiant,' . $id,
        ];
    }

    public function etagereLinked()
    {
        return $this->belongsTo(Etagere::class, 'etagere');
    }
}
