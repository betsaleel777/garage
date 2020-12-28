<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInterventionsAddResumeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->unsignedBigInteger('reparation_terminee')->nullable();
            $table->foreign('reparation_terminee')->references('id')->on('reparations_terminees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interventions', function (Blueprint $table) {
            //
        });
    }
}
