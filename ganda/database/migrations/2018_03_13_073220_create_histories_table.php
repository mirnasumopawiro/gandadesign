<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('customers_id')->unsigned();
            $table->uuid('orders_id')->unsigned();
            $table->uuid('order_details_id')->unsigned();
            $table->timestamps();
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->foreign('order_details_id')->references('id')->on('order_details');
        });

        DB::statement('ALTER TABLE histories ALTER COLUMN id SET DEFAULT uuid_generation_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
