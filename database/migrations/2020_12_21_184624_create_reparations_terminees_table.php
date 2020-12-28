<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparationsTermineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations_terminees', function (Blueprint $table) {
            $table->id();
            $table->longText('texte');
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->string('etat_validation')->default('non validé');
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
        Schema::dropIfExists('reparations_terminees');
    }
}
