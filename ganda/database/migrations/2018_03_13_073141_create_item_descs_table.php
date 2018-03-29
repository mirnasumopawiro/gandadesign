<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDescsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_descs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('items_id')->unsigned();
            $table->string('size');
            $table->string('color');
            $table->timestamps();
            $table->foreign('items_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_descs');
    }
}
