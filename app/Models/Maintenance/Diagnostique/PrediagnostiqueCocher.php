<?php

namespace App\Models\Maintenance\Diagnostique;

use Illuminate\Database\Eloquent\Model;

class PrediagnostiqueCocher extends Model
{
    protected $fillable = ['housse_interne_cocher', 'eclairage_int_cocher', 'klaxon_cocher', 'pedale_frein_cocher',
        'pedale_embreillage_cocher', 'frein_main_cocher', 'ceintures_securite_cocher', 'feux_phares_cocher', 'balais_eg_cocher', 'leve_vitre_cocher', 'eraflures_cocher',
        'corrosion_rouille_cocher', 'elements_endommages_cocher', 'clarte_feux_phares_cocher', 'etat_balais_eg_cocher', 'trape_carburant_cocher', 'poignees_portes_cocher',
        'pneux_pression_usure_cocher', 'niveaux_liquides_cocher', 'raccords_durite_cocher', 'batterie_cosses_cocher', 'disques_tambours_frein_cocher',
        'pneux_int_cocher', 'suspensions_cocher', 'volant_direction_cocher', 'pot_echappement_cocher', 'silent_bloc_cocher', 'tuyauterie_frein_cocher', 'fuite_huile_cocher',
        'sous_carrosserie_cocher', 'user', 'etat_radiateur_cocher',
    ];

    protected $table = 'prediagnostiques_cocher';
}
