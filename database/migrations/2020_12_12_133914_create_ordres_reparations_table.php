<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdresReparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordres_reparations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('couleur', 15);
            $table->unsignedBigInteger('diagnostique');
            $table->unsignedBigInteger('reception');
            $table->unsignedBigInteger('preessai');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('surcusale');
            $table->foreign('diagnostique')->references('id')->on('diagnostiques')->onDelete('cascade');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
            $table->foreign('preessai')->references('id')->on('preessais')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ordres_repartions');
    }
}
