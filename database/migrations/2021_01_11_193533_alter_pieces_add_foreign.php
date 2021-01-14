<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPiecesAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pieces', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie');
            $table->unsignedBigInteger('sous_categorie')->nullable();
            $table->foreign('categorie')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sous_categorie')->references('id')->on('sous_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pieces', function (Blueprint $table) {
            //
        });
    }
}
