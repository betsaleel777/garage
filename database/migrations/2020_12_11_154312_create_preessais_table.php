<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreessaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preessais', function (Blueprint $table) {
            $table->id();
            $table->longText('commentaire');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->unsignedBigInteger('reception');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
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
        Schema::dropIfExists('preessais');
    }
}
