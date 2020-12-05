<?php

namespace App\Models\Maintenance\Reception;

use App\Models\Personne;
use App\Models\Systeme\TypesReparation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'nom_deposant', 'ressenti', 'etat_validation', 'statut', 'etat_vehicule',
        'personne', 'vehicule_info', 'type_reparation', 'surcusale', 'hangar', 'user',
    ];

    protected $dates = ['created_at', 'updated_at'];

    const RULES = [
        'nom_deposant' => 'nullable',
        'ressenti' => 'required',
        'type_reparation' => 'required',
    ];

    public function immatriculer(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'REC' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function est_valide()
    {
        return $this->attributes['etat_validation'] === 'validé';
    }

    public function valider()
    {
        $this->attributes['etat_validation'] = 'validé';
    }

    public function invalider()
    {
        $this->attributes['etat_validation'] = null;
    }

    //relations

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function vehicule()
    {
        return $this->belongsTo(VehiculeInfo::class, 'vehicule_info');
    }

    public function reparation()
    {
        return $this->belongsTo(TypesReparation::class, 'type_reparation');
    }

    public function etat()
    {
        return $this->belongsTo(EtatVehicule::class, 'etat_vehicule');
    }

    public function personneLinked()
    {
        return $this->belongsTo(Personne::class, 'personne');
    }
}
