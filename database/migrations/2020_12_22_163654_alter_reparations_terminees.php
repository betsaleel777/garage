<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReparationsTerminees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reparations_terminees', function (Blueprint $table) {
            $table->unsignedBigInteger('reparation')->nullable();
            $table->foreign('reparation')->references('id')->on('ordres_reparations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reparations_terminees', function (Blueprint $table) {
            //
        });
    }
}
