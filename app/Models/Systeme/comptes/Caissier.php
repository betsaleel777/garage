<?php

namespace App\Models\Systeme\Comptes;

use App\Models\Systeme\Surcusale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caissier extends Model
{
    use HasFactory;
    protected $fillable = ['matricule', 'nom', 'prenom', 'email', 'contact', 'description', 'surcusale', 'caisse'];

    public function surcusaleLinked()
    {
        return $this->belongsTo(Surcusale::class, 'surcusale');
    }
}
