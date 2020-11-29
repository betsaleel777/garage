<?php

namespace App\Models\Systeme;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surcusale extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'lieu', 'gerant'];
    const RULES = [
        'nom' => 'required|max:191',
        'lieu' => 'required|max:191',
        'gerant' => 'required|max:191',
    ];
}
