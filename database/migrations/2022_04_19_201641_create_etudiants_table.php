<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('filiere_id');
            $table->unsignedBigInteger('succursale_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('genre');
            $table->string('date_anniv');
            $table->integer('contact_1');
            $table->integer('contact_2')->nullable();
            $table->string('adresse');
            $table->string('nationalite');
            $table->string('matricule');
            //$table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
            $table->foreign('succursale_id')->references('id')->on('succursales')->onDelete('cascade');
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
        Schema::dropIfExists('etudiants');
    }
}
