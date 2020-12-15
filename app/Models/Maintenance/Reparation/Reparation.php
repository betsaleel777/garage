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
}
