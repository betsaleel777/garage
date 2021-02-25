<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesSimplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes_simples', function (Blueprint $table) {
            $table->id();
            $table->longText('notes')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('magasin');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('fournisseur');
            $table->foreign('magasin')->references('id')->on('magasins')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fournisseur')->references('id')->on('fournisseurs')->onDelete('cascade');
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
        Schema::dropIfExists('commandes_simples');
    }
}
