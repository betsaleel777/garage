<?php

namespace App\Models\Maintenance\Reception;

use App\Models\Maintenance\Diagnostique\Diagnostique;
use App\Models\Maintenance\Diagnostique\Prediagnostique;
use App\Models\Maintenance\Essai\Preessai;
use App\Models\Personne;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $fillable = [
        'code', 'nom_deposant', 'ressenti', 'etat_validation', 'statut', 'etat_vehicule',
        'personne', 'vehicule_info', 'type_reparation', 'surcusale', 'hangar', 'user',
    ];

    protected $dates = ['created_at', 'updated_at'];

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
        $this->attributes['statut'] = "à l'essais";
    }

    public function reparer()
    {
        $this->attributes['statut'] = "attente réparation";
    }

    public function invalider()
    {
        $this->attributes['etat_validation'] = null;
    }

    public function scopeValide($query)
    {
        return $query->where('etat_validation', 'validé');
    }

    public function scopeDiagnosticable($query)
    {
        return $query->where('statut', 'attente diagnostique');
    }

    public function scopeDiagnosticableAdmin($query)
    {
        return $query->orWhere('statut', 'attente diagnostique')->orWhere('statut', 'attente réparation');
    }

    public function scopeReparable($query)
    {
        return $query->where('statut', 'attente réparation');
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

    public function etat()
    {
        return $this->belongsTo(EtatVehicule::class, 'etat_vehicule');
    }

    public function personneLinked()
    {
        return $this->belongsTo(Personne::class, 'personne');
    }

    public function preessai()
    {
        return $this->hasOne(Preessai::class, 'reception');
    }

    public function diagnostique()
    {
        return $this->hasOne(Diagnostique::class, 'reception');
    }

    public function prediagnostique()
    {
        return $this->hasOne(Prediagnostique::class, 'reception');
    }
}
