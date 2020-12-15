<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('nom_deposant');
            $table->longText('ressenti');
            $table->string('etat_validation')->default('non validé');
            $table->string('statut')->default('arrivé recente');
            $table->unsignedBigInteger('etat_vehicule');
            $table->unsignedBigInteger('personne');
            $table->unsignedBigInteger('vehicule_info');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->unsignedBigInteger('hangar')->nullable();
            $table->foreign('personne')->references('id')->on('personnes')->onDelete('cascade');
            $table->foreign('vehicule_info')->references('id')->on('vehicules_infos')->onDelete('cascade');
            $table->foreign('etat_vehicule')->references('id')->on('etats_vehicules')->onDelete('cascade');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
            $table->foreign('hangar')->references('id')->on('hangars')->onDelete('cascade');
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
        Schema::dropIfExists('receptions');
    }
}
