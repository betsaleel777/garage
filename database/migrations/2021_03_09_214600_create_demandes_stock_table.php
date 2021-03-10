<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes_stock', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('motif');
            $table->string('urgence');
            $table->string('nom')->nullable();
            $table->string('destinataire');
            $table->unsignedBigInteger('reparation')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reparation')->references('id')->on('ordres_reparations')->onDelete('cascade');
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
        Schema::dropIfExists('demandes_stock');
    }
}
