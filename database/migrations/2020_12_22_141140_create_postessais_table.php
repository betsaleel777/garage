<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostessaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postessais', function (Blueprint $table) {
            $table->id();
            $table->longText('commentaire');
            $table->string('etat_validation')->default('non validé');
            $table->boolean('accepter')->default(false);
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('reception');
            $table->unsignedBigInteger('surcusale')->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reception')->references('id')->on('receptions')->onDelete('cascade');
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
        Schema::dropIfExists('postessais');
    }
}
