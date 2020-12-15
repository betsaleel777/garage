<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeInfo extends Model
{
    use HasFactory;
    protected $table = 'vehicules_infos';
    protected $fillable = ['nom_deposant', 'marque', 'modele', 'type_vehicule', 'couleur', 'annee', 'enjoliveur', 'niveau_carburant', 'immatriculation',
        'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel', 'prochaine_vidange'];

    protected $dates = ['date_sitca', 'date_assurance', 'created_at'];

    const RULES = [
        'marque' => 'required',
        'modele' => 'required',
        'type_vehicule' => 'required',
        'couleur' => 'required',
        'annee' => 'required',
        'niveau_carburant' => 'required',
        'immatriculation' => 'required|unique:vehicules_infos',
        'chassis' => 'required|unique:vehicules_infos',
        'dmc' => 'required',
        'date_sitca' => 'required',
        'date_assurance' => 'required',
        'kilometrage_actuel' => 'required',
        'prochaine_vidange' => 'required',
    ];
}
