<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesCommandesSimplesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces_commandes_simples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prix_achat');
            $table->unsignedBigInteger('prix_vente');
            $table->unsignedBigInteger('piece');
            $table->unsignedBigInteger('commande');
            $table->unsignedMediumInteger('quantite');
            $table->foreign('piece')->references('id')->on('pieces')->onDelete('cascade');
            $table->foreign('commande')->references('id')->on('commandes_simples')->onDelete('cascade');
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
        Schema::dropIfExists('pieces_commandes_simples');
    }
}
