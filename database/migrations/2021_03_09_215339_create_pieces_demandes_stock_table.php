<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesDemandesStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces_demandes_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('piece');
            $table->unsignedBigInteger('demande');
            $table->unsignedMediumInteger('quantite');
            $table->foreign('piece')->references('id')->on('pieces')->onDelete('cascade');
            $table->foreign('demande')->references('id')->on('demandes_stock')->onDelete('cascade');
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
        Schema::dropIfExists('pieces_demandes_stock');
    }
}
