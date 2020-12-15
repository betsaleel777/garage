<?php

namespace App\Models\Maintenance\Essai;

use App\Models\Maintenance\Reception\Reception;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Preessai extends Model
{
    protected $fillable = ['commentaire', 'user', 'surcusale', 'reception', 'etat_validation'];
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

    public function receptionLinked()
    {
        return $this->hasOne(Reception::class, 'reception');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

}
