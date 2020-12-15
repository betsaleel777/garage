<?php

namespace App\Models\Maintenance;

use App\Models\Maintenance\Diagnostique\Diagnostique;
use App\Models\Maintenance\Reparation\Reparation;
use App\Models\Systeme\Atelier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = ['commentaire', 'atelier', 'user', 'surcusale', 'diagnostique', 'reparation'];
    protected $dates = ['created_at'];

    const RULES = [
        'commentaire' => 'required',
        'atelier' => 'required|numeric',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function atelierLinked()
    {
        return $this->belongsTo(Atelier::class, 'atelier');
    }

    public function diagnostiqueLinked()
    {
        return $this->belongsTo(Diagnostique::class, 'diagnostique');

    }

    public function reparationLinked()
    {
        return $this->belongsTo(Reparation::class, 'reparation');
    }

}
