<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carts_id')->unsigned();
            $table->integer('customers_id')->unsigned();
            $table->date('dateOpen');
            $table->date('dateClose');
            $table->string('orderStatus');
            $table->string('paymentType');
            $table->string('paymentStatus');
            $table->string('shipType');
            $table->decimal('shipPrice');
            $table->decimal('totalPrice');
            $table->timestamps();
            $table->foreign('carts_id')->references('id')->on('carts');
            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
