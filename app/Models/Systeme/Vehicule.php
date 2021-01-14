<?php

namespace App\Models\Systeme;

use App\Models\Stock\Piece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'type', 'annee', 'modele'];
    const RULES = [
        'designation' => 'required|unique:vehicules,designation',
        'marque' => 'required',
        'type' => 'required',
        'annee' => 'required',
        'modele' => 'required',
    ];

    public static function regles(int $id): array
    {
        return [
            'designation' => 'required|unique:vehicules,designation,' . $id,
            'marque' => 'required',
            'type' => 'required',
            'annee' => 'required',
            'modele' => 'required',
        ];
    }

    public function pieces()
    {
        return $this->belongsTo(Piece::class, 'vehicule');
    }
}
