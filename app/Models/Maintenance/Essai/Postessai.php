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

    public function est_valide()
    {
        return $this->attributes['etat_validation'] === 'validé';
    }

    public function valider()
    {
        $this->attributes['etat_validation'] = 'validé';
    }

    public function invalider()
    {
        $this->attributes['etat_validation'] = null;
    }
}
