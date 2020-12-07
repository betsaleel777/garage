<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeInfo extends Model
{
    use HasFactory;
    protected $table = 'vehicules_infos';
    protected $fillable = ['nom_deposant', 'enjoliveur', 'niveau_carburant', 'vehicule', 'immatriculation',
        'chassis', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel', 'prochaine_vidange'];

    protected $dates = ['date_sitca', 'date_assurance', 'created_at'];

    const RULES = [
        'enjoliveur' => 'required',
        'niveau_carburant' => 'required',
        'vehicule' => 'required',
        'immatriculation' => 'required',
        'chassis' => 'required',
        'dmc' => 'required',
        'date_sitca' => 'required',
        'date_assurance' => 'required',
        'kilometrage_actuel' => 'required',
        'prochaine_vidange' => 'required',
    ];
}
