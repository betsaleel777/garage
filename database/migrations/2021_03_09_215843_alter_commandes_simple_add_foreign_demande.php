<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCommandesSimpleAddForeignDemande extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commandes_simples', function (Blueprint $table) {
            $table->unsignedBigInteger('demande');
            $table->foreign('demande')->references('id')->on('demandes_stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes_simples', function (Blueprint $table) {
            //
        });
    }
}
