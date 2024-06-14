<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoBienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_bien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bien');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('id_bien')->references('id')->on('bien_immo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_bien');
    }
}
