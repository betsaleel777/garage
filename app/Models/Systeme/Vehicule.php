<?php

namespace App\Models\Systeme;

use App\Models\Stock\Piece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'annee', 'modele', 'carburant', 'boite'];
    const RULES = [
        'designation' => 'nullable|unique:vehicules,designation',
        'marque' => 'required',
        'annee' => 'required',
        'modele' => 'required',
        'carburant' => 'required',
        'boite' => 'required',
    ];

    public function makeName()
    {
        $vitesse = $this->attributes['boite'];
        $carburant = $this->attributes['carburant'];
        $this->attributes['designation'] = $this->attributes['marque'] . '_' . $this->attributes['modele'] . '_' . substr($carburant, 0, 4) . '_' . substr($vitesse, 0, 4) . '_' . $this->attributes['annee'];
    }

    public function pieces()
    {
        return $this->hasMany(Piece::class, 'vehicule');
    }
}
