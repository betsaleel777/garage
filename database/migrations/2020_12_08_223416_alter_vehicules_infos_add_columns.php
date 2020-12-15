<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiculesInfosAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicules_infos', function (Blueprint $table) {
            $table->string('marque');
            $table->string('type_vehicule');
            $table->string('couleur');
            $table->string('modele');
            $table->string('annee');
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
