<?php

namespace App\Models\Maintenance\Essai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postessai extends Model
{
    use HasFactory;
    protected $fillable = ['commentaire', 'user', 'surcusale', 'etat_validation', 'accepter', 'reception'];
    protected $dates = ['created_at'];
    const RULES = [
        'commentaire' => 'required',
    ];
}
