<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiculesInfosAddVehiculeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicules_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicule')->nullable();
            $table->foreign('vehicule')->references('id')->on('vehicule_receptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicules_infos', function (Blueprint $table) {
            //
        });
    }
}
