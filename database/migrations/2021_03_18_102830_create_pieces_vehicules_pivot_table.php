<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesVehiculesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces_vehicules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('piece')->nullable();
            $table->unsignedBigInteger('vehicule')->nullable();
            $table->foreign('vehicule')->references('id')->on('vehicules')->onDelete('cascade');
            $table->foreign('piece')->references('id')->on('pieces')->onDelete('cascade');
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
        Schema::dropIfExists('pieces_vehicules');
    }
}
