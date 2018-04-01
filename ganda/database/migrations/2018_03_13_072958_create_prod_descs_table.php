<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdDescsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_descs', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('products_id')->unsigned();
            $table->string('size');
            $table->integer('stock');
            $table->timestamps();
            $table->foreign('products_id')->references('id')->on('products');
        });

        DB::statement('ALTER TABLE prod_descs ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_descs');
    }
}
