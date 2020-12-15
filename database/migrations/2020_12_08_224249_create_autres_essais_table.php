<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutresEssaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autres_essais', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('commentaire');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('reception');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
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
        Schema::dropIfExists('autres_essais');
    }
}
