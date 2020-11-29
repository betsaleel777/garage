<?php

namespace App\Models\Systeme;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesReparation extends Model
{
    use HasFactory;
    protected $table = 'types_reparations';
    protected $fillable = ['nom', 'prix_forfaitaire', 'surcusale'];

    const RULES = [
        'nom' => 'required|max:191',
        'prix_forfaitaire' => 'required|numeric',
    ];

    public function surcusaleLinked()
    {
        return $this->belongsTo(Surcusale::class, 'surcusale');
    }
}
