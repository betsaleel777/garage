<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->longText('commentaire');
            $table->unsignedBigInteger('atelier');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->unsignedBigInteger('user');
            $table->foreign('atelier')->references('id')->on('ateliers')->onDelete('cascade');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            //doit être lié aux pièces de rechange
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
}
