<?php

namespace App\Models\Maintenance\Diagnostique;

use App\Models\Maintenance\Reception\Reception;
use Illuminate\Database\Eloquent\Model;

class Prediagnostique extends Model
{
    protected $fillable = ['reception', 'etat_validation', 'housse_interne', 'eclairage_int', 'klaxon', 'pedale_frein',
        'pedale_embreillage', 'frein_main', 'ceintures_securite', 'feux_phares', 'balais_eg', 'leve_vitre', 'eraflures',
        'corrosion_rouille', 'elements_endommages', 'clarte_feux_phares', 'etat_balais_eg', 'trape_carburant', 'poignees_portes',
        'pneux_pression_usure', 'niveaux_liquides', 'raccords_durite', 'batterie_cosses', 'disques_tambours_frein',
        'pneux_int', 'suspensions', 'volant_direction', 'pot_echappement', 'silent_bloc', 'tuyauterie_frein', 'fuite_huile',
        'sous_carrosserie', 'user', 'etat_radiateur',
    ];

    protected $dates = ['created_at'];

    const RULES = [
        'reception' => 'required',
    ];

    //relations
    public function receptionLinked()
    {
        return $this->belongsTo(Reception::class, 'reception');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
