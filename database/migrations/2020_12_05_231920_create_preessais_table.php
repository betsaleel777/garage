<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreessaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preessais', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->longText('protection_interne')->nullable();
            $table->longText('housse_protection')->nullable();
            $table->longText('eclairage_int')->nullable();
            $table->longText('klaxon')->nullable();
            $table->longText('pedale_frein')->nullable();
            $table->longText('pedale_embreillage')->nullable();
            $table->longText('frein_main')->nullable();
            $table->longText('ceintures_securite')->nullable();
            $table->longText('feux_phares')->nullable();
            $table->longText('balais_eg')->nullable();
            $table->longText('leve_vitre')->nullable();
            $table->longText('eraflures')->nullable();
            $table->longText('corrosion_rouille')->nullable();
            $table->longText('elements_endommages')->nullable();
            $table->longText('clarte_feux_phares')->nullable();
            $table->longText('etat_balais_eg')->nullable();
            $table->longText('trape_carburant')->nullable();
            $table->longText('poignees_portes')->nullable();
            $table->longText('pneux_pression_usure')->nullable();
            $table->longText('niveaux_liquides')->nullable();
            $table->longText('raccords_durite')->nullable();
            $table->longText('batterie_cosses')->nullable();
            $table->longText('disques_tambours_frein')->nullable();
            $table->longText('pneux_int')->nullable();
            $table->longText('suspensions')->nullable();
            $table->longText('volant_direction')->nullable();
            $table->longText('pot_echappement')->nullable();
            $table->longText('silent_bloc')->nullable();
            $table->longText('tuyauterie_frein')->nullable();
            $table->longText('fuite_huile')->nullable();
            $table->longText('sous_carrosserie')->nullable();
            $table->longText('test_routier')->nullable();
            $table->unsignedBigInteger('reception')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('preessais');
    }
}
