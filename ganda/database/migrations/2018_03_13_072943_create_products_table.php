<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('sub_categories_id')->unsigned();
            $table->string('name');
            $table->decimal('price');
            $table->string('description');
            $table->string('material');
            $table->string('tag');
            $table->timestamps();
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories');
        });

        DB::statement('ALTER TABLE products ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
