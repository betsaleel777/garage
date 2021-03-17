<?php

namespace App\Models\Stock;

use App\Models\Finance\Commande\CommandeSimple;
use App\Models\Systeme\Vehicule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'nom', 'sous_categorie', 'categorie', 'type_piece', 'fiche', 'vehicule', 'etat_piece', 'reference', 'image', 'emplacement'];
    const RULES = [
        'categorie' => 'required',
        'vehicule' => 'required',
        'sous_categorie' => 'required',
        'type_piece' => 'required',
        'reference' => 'required',
        'etat_piece' => 'required',
        'emplacement' => 'required',
        'fiche' => 'nullable|file|mimes:pdf',
    ];

    public function makeCode()
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'PIE' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function makeName(string $scategorie, string $etat, string $type, string $vehicule)
    {
        $this->attributes['nom'] = $scategorie . '_' . substr($etat, 0, 5) . '_' . substr($type, 0, 5) . '_' . $vehicule;
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

    public function emplacementLinked()
    {
        return $this->belongsTo(Tiroir::class, 'emplacement');
    }

    public function commandeSimple()
    {
        return $this->belongsToMany(CommandeSimple::class, 'pieces_commandes_simples', 'piece', 'commande')
            ->withPivot('quantite', 'prix_achat', 'prix_vente')
            ->withTimestamps();
    }
}
