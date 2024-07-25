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
            $table->id(); // ID de l'annonce
            $table->string('libelle'); // Libellé de l'annonce
            $table->decimal('prix', 10, 2); // Prix de l'annonce
            $table->string('etat'); // État de l'annonce
            $table->string('adresse'); // Adresse de l'annonce
            $table->string('ville'); // Ville de l'annonce
            $table->string('code_postal'); // Code postal
            $table->decimal('superficie', 10, 2); // Superficie de l'annonce (m²)
            $table->string('type'); // Type de bien (appartement, maison, etc.)
            $table->text('description'); // Description de l'annonce
            $table->unsignedBigInteger('created_by'); // ID de l'utilisateur qui a créé l'annonce
            $table->timestamps(); // Ajoute created_at et updated_at

            // Définir une clé étrangère sur 'created_by'
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
