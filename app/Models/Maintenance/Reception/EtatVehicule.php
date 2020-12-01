<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatVehicule extends Model
{
    use HasFactory;
    protected $table = 'etats_vehicules';
    protected $fillable = ['eclairage_int', 'retroviseurs_int', 'klaxon', 'essuies_glaces', 'radio', 'climatisation',
        'frein_stationnement', 'sieges', 'tableau_bord', 'leve_vitre', 'verouillage_portes', 'ouverture_portes_int',
        'roues', 'feux_arrieres', 'balais_essuies_glace_av', 'balais_essuies_glace_ar', 'trape_carburant', 'ouverture_portes_ext',
        'retroviseurs_ext', 'cle_contact', 'clignotants', 'veilleuses', 'feux_croisement', 'feux_recul', 'feux_stop',
        'feux_antibrouillard', 'cric', 'roues_secours', 'manivelle', 'trousse', 'huile_moteur', 'huile_frein', 'huile_direction',
        'liquide_refroidissement', 'liquide_lave_glace',
    ];

    const RULES = [
        'eclairage_int' => 'required',
        'retroviseurs_int' => 'required',
        'klaxon' => 'required',
        'essuies_glaces' => 'required',
        'radio' => 'required',
        'climatisation' => 'required',
        'frein_stationnement' => 'required',
        'sieges' => 'required',
        'tableau_bord' => 'required',
        'leve_vitre' => 'required',
        'verouillage_portes' => 'required',
        'ouverture_portes_int' => 'required',
        //extérieur
        'roues' => 'required',
        'feux_arrieres' => 'required',
        'balais_essuies_glace_av' => 'required',
        'balais_essuies_glace_ar' => 'required',
        'trape_carburant' => 'required',
        'ouverture_portes_ext' => 'required',
        'retroviseurs_ext' => 'required',
        'cle_contact' => 'required',
        'clignotants' => 'required',
        'veilleuses' => 'required',
        'feux_croisement' => 'required',
        'feux_recul' => 'required',
        'feux_stop' => 'required',
        'feux_antibrouillard' => 'required',
        'cric' => 'required',
        'roues_secours' => 'required',
        'manivelle' => 'required',
        'trousse' => 'required',
        //sous le capot
        'huile_moteur' => 'required',
        'huile_frein' => 'required',
        'huile_direction' => 'required',
        'liquide_refroidissement' => 'required',
        'liquide_lave_glace' => 'required',
    ];
}
