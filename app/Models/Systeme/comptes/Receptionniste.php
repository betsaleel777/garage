<?php

namespace App\Models\Systeme\Comptes;

use App\Models\Maintenance\Reception\Hangar;
use App\Models\Systeme\Surcusale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionniste extends Model
{
    use HasFactory;
    protected $fillable = ['matricule', 'nom', 'prenom', 'email', 'contact', 'description', 'surcusale', 'hangar'];

    public function surcusaleLinked()
    {
        return $this->belongsTo(Surcusale::class, 'surcusale');
    }

    public function hangarLinked()
    {
        return $this->hasOne(Hangar::class, 'hangar');
    }
}
