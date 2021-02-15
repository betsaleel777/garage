<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtageresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etageres', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('identifiant')->unique()->index();
            $table->unsignedBigInteger('zone')->nullable();
            $table->foreign('zone')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('etageres');
    }
}
