<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtatVehicule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etats_vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('eclairage_int', 20);
            $table->string('retroviseurs_int', 20);
            $table->string('klaxon', 20);
            $table->string('essuies_glace', 20);
            $table->string('radio', 20);
            $table->string('climatisation', 20);
            $table->string('frein_stationnement', 20);
            $table->string('sieges', 20);
            $table->string('tableau_bord', 20);
            $table->string('leve_vitre', 20);
            $table->string('verouillage_portes', 20);
            $table->string('ouverture_portes_int', 20);
            $table->string('roues', 20);
            $table->string('feux_arrieres', 20);
            $table->string('balais_essuis_glace_av', 20);
            $table->string('balais_essuis_glace_ar', 20);
            $table->string('trape_carburant', 20);
            $table->string('ouverture_portes_ext', 20);
            $table->string('retroviseurs_ext', 20);
            $table->string('cle_contact', 20);
            $table->string('clignotants', 20);
            $table->string('veilleuses', 20);
            $table->string('feux_croisement', 20);
            $table->string('feux_recul', 20);
            $table->string('feux_stop', 20);
            $table->string('feux_antibrouillard', 20);
            $table->string('cric', 20);
            $table->string('roues_secours', 20);
            $table->string('manivelle', 20);
            $table->string('trousse', 20);
            $table->string('huile_moteur', 20);
            $table->string('huile_frein', 20);
            $table->string('huile_direction', 20);
            $table->string('liquide_refroidissement', 20);
            $table->string('liquide_lave_glace', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etats_vehicules');
    }
}
