<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = array('nom', 'user', 'image');

    const RULES = [
        'nom' => 'required|unique:categories,nom',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:categories,nom,' . $id,
        ];
    }

    public function enfants()
    {
        return $this->hasMany(SousCategorie::class, 'categorie');
    }
}
