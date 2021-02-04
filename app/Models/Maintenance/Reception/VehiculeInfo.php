<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeInfo extends Model
{
    use HasFactory;
    protected $table = 'vehicules_infos';
    protected $fillable = ['nom_deposant', 'niveau_carburant', 'vehicule', 'dmc', 'date_sitca', 'date_assurance', 'kilometrage_actuel', 'prochaine_vidange'];

    protected $dates = ['date_sitca', 'date_assurance', 'created_at'];

    const RULES = [
        'niveau_carburant' => 'required',
        'dmc' => 'required',
        'date_sitca' => 'required',
        'date_assurance' => 'required',
        'kilometrage_actuel' => 'required',
        'prochaine_vidange' => 'required|gte:kilometrage_actuel',
    ];

    public function enjoliveurs()
    {
        return $this->belongsToMany(Enjoliveur::class, 'enjoliveurs_vehicules', 'vehicule_info', 'enjoliveur')->withTimestamps();
    }

    public function auto()
    {
        return $this->belongsTo(VehiculeReception::class, 'vehicule');
    }
}
