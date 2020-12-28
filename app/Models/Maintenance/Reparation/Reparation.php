<?php

namespace App\Models\Maintenance\Reparation;

use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    protected $fillable = ['code', 'couleur', 'diagnostique', 'reception', 'preessai', 'user', 'surcusale'];
    protected $dates = ['created_at'];
    protected $table = 'ordres_reparations';
    const RULES = [
        'code' => 'required|unique:ordres_reparations',
        'couleur' => 'required',
    ];

    const REPARATION_START = 'red';
    const REPARATION_END = 'yellow';
    const REPARATION_VALIDE = 'green';

    public function immatriculer(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'ORE' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function est_valide()
    {
        return $this->attributes['couleur'] === self::REPARATION_VALIDE;
    }

    public function en_transition()
    {
        return $this->attributes['couleur'] === self::REPARATION_END;
    }

    public function finir()
    {
        $this->attributes['couleur'] = self::REPARATION_END;
    }

    public function valider()
    {
        $this->attributes['couleur'] = self::REPARATION_VALIDE;
    }

    public function scopeNotFinished($query)
    {
        return $query->orWhere('couleur', self::REPARATION_START)->orWhere('couleur', self::REPARATION_END);
    }

    public function finished()
    {
        return $this->hasMany(ReparationTerminee::class, 'reparation');
    }
}
