<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHangars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hangars', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
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
        Schema::dropIfExists('hangars');
    }
}
