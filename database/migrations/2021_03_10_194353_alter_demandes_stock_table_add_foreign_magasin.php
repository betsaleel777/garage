<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDemandesStockTableAddForeignMagasin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('magasin')->nullable();
            $table->foreign('magasin')->references('id')->on('magasins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demandes_stock', function (Blueprint $table) {
            //
        });
    }
}
