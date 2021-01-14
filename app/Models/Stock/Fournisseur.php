<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = array('nom', 'contact', 'email', 'siege');

    const RULES = [
        'nom' => 'required|unique:fournisseurs,nom',
        'contact' => 'required|unique:fournisseurs,contact',
        'email' => 'nullable|email|unique:fournisseurs,email',
    ];

    public static function regles(int $id)
    {
        return [
            'nom' => 'required|unique:fournisseurs,nom,' . $id,
            'contact' => 'required|unique:fournisseurs,contact,' . $id,
            'email' => 'required|email|unique:fournisseurs,email,' . $id,
        ];
    }
}
