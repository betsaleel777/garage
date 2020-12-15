<?php

namespace App\Models\Maintenance\Diagnostique;

use Illuminate\Database\Eloquent\Model;

class Diagnostique extends Model
{
    protected $fillable = ['panne', 'temps_estime', 'reception', 'surcusale', 'user', 'etat_validation'];
    protected $dates = ['created_at', 'updated_at'];

    const RULES = [
        'temps_estime' => 'required',
        'panne' => 'required',
    ];

    public function est_valide()
    {
        return $this->attributes['etat_validation'] === 'validé';
    }

    public function valider(): void
    {
        $this->attributes['etat_validation'] = 'validé';
    }
}
