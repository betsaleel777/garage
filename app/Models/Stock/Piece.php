<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'nom', 'prix_achat', 'prix_vente', 'sous_categorie', 'categorie', 'type', 'image', 'fiche'];
    const RULES = [
        'nom' => 'required|unique:pieces,nom',
        'prix_achat' => 'required',
        'prix_vente' => 'required|gte:prix_achat',
        'categorie' => 'required',
        'type' => 'required',
        'image' => 'nullable|file|mimes:jpg,jpeg,png|dimensions:ratio=1',
        'fiche' => 'nullbale|file|mimes:pdf',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:pieces,nom,' . $id,
            'prix_achat' => 'required',
            'prix_vente' => 'required|gte:prix_achat',
            'categorie' => 'required',
            'type' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|dimensions:ratio=1',
            'fiche' => 'nullbale|file|mimes:pdf',
        ];
    }

    public function categorieLinked()
    {
        return $this->belongsTo(Categorie::class, 'categorie');
    }

    public function categorie_enfant()
    {
        return $this->belongsTo(SousCategorie::class, 'sous_categorie');
    }
}
