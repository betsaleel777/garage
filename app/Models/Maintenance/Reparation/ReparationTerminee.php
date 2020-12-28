<?php

namespace App\Models\Maintenance\Reparation;

use App\Models\Maintenance\Intervention;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReparationTerminee extends Model
{
    use HasFactory;
    protected $fillable = ['etat_validation', 'texte', 'user'];
    protected $dates = ['created_at'];
    protected $table = 'reparations_terminees';
    const RULES = [
        'texte' => 'required',
    ];

    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'reparation_terminee');
    }
}
