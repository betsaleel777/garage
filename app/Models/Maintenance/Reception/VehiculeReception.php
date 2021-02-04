<?php

namespace App\Models\Maintenance\Reception;

use App\Models\Personne;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeReception extends Model
{
    use HasFactory;

    protected $fillable = ['personne', 'couleur', 'annee', 'modele', 'type_vehicule', 'chassis', 'immatriculation', 'marque'];

    const RULES = [
        'couleur' => 'required',
        'annee' => 'required',
        'modele' => 'required',
        'type_vehicule' => 'required',
        'chassis' => 'required|unique:vehicule_receptions,chassis',
        'immatriculation' => 'required|unique:vehicule_receptions,immatriculation',
        'marque' => 'required',
    ];

    public function personneLinked()
    {
        return $this->belongsTo(Personne::class, 'personne');
    }

    public function utilisateur()
    {
        return $this->hasOne(User::class, 'user');
    }

    public function infos_reception()
    {
        return $this->hasMany(VehiculeInfo::class, 'vehicule');
    }
}
