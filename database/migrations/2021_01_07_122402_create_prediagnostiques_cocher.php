<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrediagnostiquesCocher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediagnostiques_cocher', function (Blueprint $table) {
            $table->id();
            $table->boolean('protection_interne_cocher')->default(false);
            $table->boolean('housse_protection_cocher')->default(false);
            $table->boolean('eclairage_int_cocher')->default(false);
            $table->boolean('klaxon_cocher')->default(false);
            $table->boolean('pedale_frein_cocher')->default(false);
            $table->boolean('pedale_embreillage_cocher')->default(false);
            $table->boolean('frein_main_cocher')->default(false);
            $table->boolean('ceintures_securite_cocher')->default(false);
            $table->boolean('feux_phares_cocher')->default(false);
            $table->boolean('balais_eg_cocher')->default(false);
            $table->boolean('leve_vitre_cocher')->default(false);
            $table->boolean('eraflures_cocher')->default(false);
            $table->boolean('corrosion_rouille_cocher')->default(false);
            $table->boolean('elements_endommages_cocher')->default(false);
            $table->boolean('clarte_feux_phares_cocher')->default(false);
            $table->boolean('etat_balais_eg_cocher')->default(false);
            $table->boolean('trape_carburant_cocher')->default(false);
            $table->boolean('poignees_portes_cocher')->default(false);
            $table->boolean('pneux_pression_usure_cocher')->default(false);
            $table->boolean('niveaux_liquides_cocher')->default(false);
            $table->boolean('raccords_durite_cocher')->default(false);
            $table->boolean('batterie_cosses_cocher')->default(false);
            $table->boolean('disques_tambours_frein_cocher')->default(false);
            $table->boolean('pneux_int_cocher')->default(false);
            $table->boolean('suspensions_cocher')->default(false);
            $table->boolean('volant_direction_cocher')->default(false);
            $table->boolean('pot_echappement_cocher')->default(false);
            $table->boolean('silent_bloc_cocher')->default(false);
            $table->boolean('tuyauterie_frein_cocher')->default(false);
            $table->boolean('fuite_huile_cocher')->default(false);
            $table->boolean('sous_carrosserie_cocher')->default(false);
            $table->boolean('etat_radiateur_cocher')->default(false);
            $table->boolean('test_routier_cocher')->default(false);
            $table->unsignedBigInteger('user')->default(false);
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->default(false);
            $table->unsignedBigInteger('prediagnostique')->default(false);
            $table->foreign('prediagnostique')->references('id')->on('prediagnostiques')->onDelete('cascade');
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
        Schema::dropIfExists('prediagnostiques_cocher');
    }
}
