<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('nom_complet')->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->string('type')->default('prospect');
            $table->string('qualificatif')->default('bon');
            $table->string('email')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->string('representant_assurance')->nullable();
            $table->string('nom_assurance')->nullable();
            $table->string('contact_assurance')->unique()->nullable();
            $table->string('email_assurance', 255)->unique()->nullable();
            $table->string('representant_entreprise')->nullable();
            $table->string('nom_entreprise')->nullable();
            $table->string('contact_entreprise')->unique()->nullable();
            $table->string('email_entreprise', 255)->unique()->nullable();
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
        Schema::dropIfExists('personnes');
    }
}
