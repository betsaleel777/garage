<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnostiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostiques', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->longText('panne')->nullable();
            $table->string('temps_estime', 20)->nullable();
            $table->unsignedBigInteger('reception');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->unsignedBigInteger('user');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
            $table->foreign('surcusale')->references('id')->on('surcusales')->onDelete('cascade');
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
        Schema::dropIfExists('diagnostiques');
    }
}
