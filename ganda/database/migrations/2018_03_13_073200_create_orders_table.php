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
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('carts_id')->unsigned();
            $table->uuid('customers_id')->unsigned();
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

        DB::statement('ALTER TABLE orders ALTER COLUMN id SET DEFAULT uuid_generation_v4();');
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
