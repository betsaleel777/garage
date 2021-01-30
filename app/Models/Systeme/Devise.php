<?php

namespace App\Models\Systeme;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devise extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'abreviation', 'current'];

    const RULES = [
        'nom' => 'required|unique:devises,nom',
        'abreviation' => 'required|unique:devises,abreviation',
    ];

    public static function regles(int $id)
    {
        return [
            'nom' => 'required|unique:devises,nom,' . $id,
            'abreviation' => 'required|unique:devises,abreviation,' . $id,
        ];
    }
}
