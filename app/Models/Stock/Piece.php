<?php

namespace App\Models\Stock;

use App\Models\Systeme\Vehicule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'nom', 'prix_achat', 'prix_vente', 'sous_categorie', 'categorie', 'emplacement', 'type_piece', 'fiche', 'vehicule', 'magasin'];
    const RULES = [
        'prix_achat' => 'required',
        'prix_vente' => 'required|gte:prix_achat',
        'categorie' => 'required',
        'sous_categorie' => 'required',
        'type_piece' => 'required',
        'fiche' => 'nullbale|file|mimes:pdf',
    ];

    public function makeCode()
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'PIE' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function makeName(string $scategorie, string $type_piece, string $vehicule)
    {
        $this->attributes['nom'] = $scategorie . '_' . substr($type_piece, 0, 5) . '_' . $vehicule;
    }

    public function categorieLinked()
    {
        return $this->belongsTo(Categorie::class, 'categorie');
    }

    public function categorieEnfant()
    {
        return $this->belongsTo(SousCategorie::class, 'sous_categorie');
    }

    public function vehiculeLinked()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule');
    }
}
