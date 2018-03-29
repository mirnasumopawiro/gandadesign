<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdDescValsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_desc_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prod_descs_id')->unsigned();
            $table->string('value');
            $table->timestamps();
            // $table->foreign('prod_descs_id')->references('id')->on('prod_descs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_desc_vals');
    }
}
