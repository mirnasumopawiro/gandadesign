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
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('item_descs_id')->unsigned();
            $table->string('value');
            $table->timestamps();
            $table->foreign('item_descs_id')->references('id')->on('item_descs');
        });

        DB::statement('ALTER TABLE item_desc_vals ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
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
