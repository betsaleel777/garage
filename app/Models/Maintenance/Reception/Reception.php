<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->immatriculer();
    }

    protected $fillable = [
        'code', 'nom_deposant', 'ressenti', 'etat_validation', 'statut', 'etat_vehicule',
        'personne', 'vehicule_info', 'type_reparation', 'surcusale', 'hangar', 'user',
    ];

    const RULES = [
        'nom_deposant' => 'nullable',
        'ressenti' => 'required',
        'type_reparation' => 'required',
    ];

    public function immatriculer(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'REC' . substr(str_shuffle($lettres), 0, 4) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    //relations
}
