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
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('prod_descs_id')->unsigned();
            $table->string('value');
            $table->timestamps();
            $table->foreign('prod_descs_id')->references('id')->on('prod_descs');
        });

        DB::statement('ALTER TABLE prod_desc_vals ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
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
