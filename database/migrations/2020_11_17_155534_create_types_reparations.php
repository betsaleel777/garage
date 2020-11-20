<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesReparations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types_reparations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prix_forfaitaire');
            $table->unsignedBigInteger('surcusale');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
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
        Schema::dropIfExists('types_reparations');
    }
}
