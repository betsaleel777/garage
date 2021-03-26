<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces_entrees', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('quantite');
            $table->unsignedBigInteger('vehicule');
            $table->unsignedBigInteger('entree');
            $table->unsignedBigInteger('piece');
            $table->foreign('vehicule')->references('id')->on('vehicules')->onDelete('cascade');
            $table->foreign('piece')->references('id')->on('pieces')->onDelete('cascade');
            $table->foreign('entree')->references('id')->on('entrees')->onDelete('cascade');
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
        Schema::dropIfExists('pieces_entrees');
    }
}
