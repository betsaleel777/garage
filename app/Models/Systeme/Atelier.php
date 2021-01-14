<?php

namespace App\Models\Systeme;

use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{
    protected $fillable = ['nom', 'description', 'surcusale', 'user'];
    protected $dates = ['created_at'];

    const RULES = [
        'nom' => 'required|unique:ateliers',
    ];

    public static function regles(int $id)
    {
        return [
            'nom' => 'required|unique:ateliers,nom,' . $id,
        ];
    }
}
