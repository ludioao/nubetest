<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperheroesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superheroes_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->unsignedInteger('superhero_id');
            $table->foreign('superhero_id')->references('id')->on('superheroes');
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
        Schema::dropIfExists('superheroes_images');
    }
}
