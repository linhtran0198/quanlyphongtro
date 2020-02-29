<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMotelRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('motelrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->integer('area');
            $table->integer('count_view');
            $table->string('address');
            $table->string('latlng');
            $table->string('images');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('district_id');
            $table->string('utilities');
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
        Schema::dropIfExists('motelrooms');
    }
}
