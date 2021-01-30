<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCommentaireReceptionsAddForeignReception extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentaire_receptions', function (Blueprint $table) {
            $table->unsignedBigInteger('reception');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentaire_receptions', function (Blueprint $table) {
            //
        });
    }
}
