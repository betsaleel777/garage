<?php

namespace App\Models\Maintenance\Reception;

use App\Models\Maintenance\Diagnostique\Diagnostique;
use App\Models\Maintenance\Diagnostique\Prediagnostique;
use App\Models\Maintenance\Essai\Postessai;
use App\Models\Maintenance\Essai\Preessai;
use App\Models\Maintenance\Reparation\Reparation;
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

    const STATUS_RECENT = 'arrivé recente';
    const STATUS_RECEPTION_DOWN = "attente pré-essais";
    const STATUS_PREESSAI_DOWN = 'attente diagnostique';
    const STATUS_DIAGNOSTIQUE_DOWN = 'attente réparation';
    const STATUS_REPARATION_DOWN = 'attente post-essais';
    const STATUS_REPARATION_REJECT = 'réparation rejétée';
    const STATUS_POSTESSAI_DOWN = 'réparé';

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
        $this->attributes['statut'] = self::STATUS_RECEPTION_DOWN;
    }

    public function reparer()
    {
        $this->attributes['statut'] = self::STATUS_DIAGNOSTIQUE_DOWN;
    }

    public function invalider()
    {
        $this->attributes['etat_validation'] = null;
    }

    public function scopeValide($query)
    {
        return $query->where('etat_validation', 'validé');
    }

    public function scopeRecent($query)
    {
        return $query->where('statut', self::STATUS_RECENT);
    }

    public function scopePreEssayable($query)
    {
        return $query->orWhere('statut', self::STATUS_RECEPTION_DOWN);
    }

    public function scopePreEssayableAdmin($query)
    {
        return $query->preEssayable()->orWhere('statut', self::STATUS_PREESSAI_DOWN);
    }

    public function scopeDiagnosticable($query)
    {
        return $query->orWhere('statut', self::STATUS_PREESSAI_DOWN);
    }

    public function scopeDiagnosticableAdmin($query)
    {
        return $query->diagnosticable()->orWhere('statut', self::STATUS_DIAGNOSTIQUE_DOWN);
    }

    public function scopeReparable($query)
    {
        return $query->orWhere('statut', self::STATUS_DIAGNOSTIQUE_DOWN)->orWhere('statut', self::STATUS_REPARATION_REJECT);
    }

    public function scopeReparableAdmin($query)
    {
        return $query->reparable()->orWhere('statut', self::STATUS_REPARATION_DOWN);
    }

    public function scopePostEssayable($query)
    {
        return $query->orWhere('statut', self::STATUS_REPARATION_DOWN);
    }

    public function scopePostEssayableAdmin($query)
    {
        return $query->postEssayable()->orWhere('statut', self::STATUS_POSTESSAI_DOWN);
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

    public function postessai()
    {
        return $this->hasOne(Postessai::class, 'reception');
    }

    public function diagnostique()
    {
        return $this->hasOne(Diagnostique::class, 'reception');
    }

    public function prediagnostique()
    {
        return $this->hasOne(Prediagnostique::class, 'reception');
    }

    public function reparation()
    {
        return $this->hasOne(Reparation::class, 'reception');
    }
}
