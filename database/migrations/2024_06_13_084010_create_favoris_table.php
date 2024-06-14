<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavorisTable extends Migration
{
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('bien_immo_id')->constrained('bien_immo')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'bien_immo_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favoris');
    }
}
