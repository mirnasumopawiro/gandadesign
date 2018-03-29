<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDescValsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_desc_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_descs_id')->unsigned();
            $table->string('value');
            $table->timestamps();
            $table->foreign('item_descs_id')->references('id')->on('item_descs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_desc_vals');
    }
}
