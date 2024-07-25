<?php

// database/migrations/xxxx_xx_xx_create_saved_searches_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedSearchesTable extends Migration
{
    public function up()
    {
        Schema::create('saved_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('search_params'); // Stocke les paramètres de recherche sous forme de JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saved_searches');
    }
}
