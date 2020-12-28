<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnjoliveursVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enjoliveurs_vehicules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enjoliveur');
            $table->unsignedBigInteger('vehicule_info');
            $table->foreign('enjoliveur')->references('id')->on('enjoliveurs')->onDelete('cascade');
            $table->foreign('vehicule_info')->references('id')->on('vehicules_infos')->onDelete('cascade');
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
        Schema::dropIfExists('enjoliveurs_vehicules');
    }
}
