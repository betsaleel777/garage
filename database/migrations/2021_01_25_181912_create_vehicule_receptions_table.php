<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculeReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule_receptions', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique();
            $table->string('chassis')->unique();
            $table->string('marque');
            $table->string('modele');
            $table->string('type_vehicule');
            $table->string('annee');
            $table->unsignedBigInteger('personne');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('personne')->references('id')->on('personnes')->onDelete('cascade');
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
        Schema::dropIfExists('vehicule_receptions');
    }
}
