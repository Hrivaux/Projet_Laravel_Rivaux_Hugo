<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienImmoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_immo', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->decimal('prix', 10, 2);
            $table->string('etat');
            $table->string('adresse'); // Ajout du champ adresse
            $table->string('ville');   // Ajout du champ ville
            $table->int('code_postal'); // Ajout du champ code_postal
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
        Schema::dropIfExists('bien_immo');
    }
}

