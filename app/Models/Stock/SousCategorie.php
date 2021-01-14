<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;
    protected $fillable = array('nom', 'user', 'categorie', 'image');

    const RULES = [
        'nom' => 'required|unique:categories,nom',
    ];

    public static function regles(int $id): array
    {
        return [
            'nom' => 'required|unique:categories,nom,' . $id,
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'categorie');
    }
}
