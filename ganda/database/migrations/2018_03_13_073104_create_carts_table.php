<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('products_id')->unsigned();
            $table->uuid('users_id')->unsigned();
            $table->integer('size');
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE carts ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
