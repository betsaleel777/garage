<?php

namespace App\Models\Systeme;

use App\Models\Stock\Piece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'type_vehicule', 'annee', 'modele'];
    const RULES = [
        'designation' => 'nullable|unique:vehicules,designation',
        'marque' => 'required',
        'type_vehicule' => 'required',
        'annee' => 'required',
        'modele' => 'required',
    ];

    public function makeName()
    {
        $this->attributes['designation'] = $this->attributes['modele'] . '_' . str_replace(' ', '-', $this->attributes['type_vehicule']) . '_' . $this->attributes['annee'];
    }

    public function pieces()
    {
        return $this->hasMany(Piece::class, 'vehicule');
    }
}
