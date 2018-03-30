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
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('items_id')->unsigned();
            $table->string('size');
            $table->string('color');
            $table->timestamps();
            $table->foreign('items_id')->references('id')->on('items');
        });

        DB::statement('ALTER TABLE item_descs ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
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
