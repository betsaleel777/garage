<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules_infos', function (Blueprint $table) {
            $table->id();
            $table->string('nom_deposant');
            $table->string('enjoliveur');
            $table->string('niveau_carburant');
            $table->string('vehicule');
            $table->string('immatriculation');
            $table->string('chassis');
            $table->string('dmc');
            $table->date('date_sitca');
            $table->date('date_assurance');
            $table->string('kilometrage_actuel');
            $table->string('prochaine_vidange');
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
        Schema::dropIfExists('vehicules_infos');
    }
}
