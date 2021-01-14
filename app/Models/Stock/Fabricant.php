<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricant extends Model
{
    use HasFactory;
    protected $fillable = array('nom', 'logo');

    const RULES = [
        'nom' => 'required|unique:magasins,nom',
    ];

    public static function regles(int $id)
    {
        return [
            'nom' => 'required|unique:magasins,nom,' . $id,
        ];
    }
}
