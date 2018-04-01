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
            $table->uuid('order_details_id')->unsigned();
            $table->uuid('users_id')->unsigned();
            $table->date('dateOpen');
            $table->date('dateClose');
            $table->string('orderStatus');
            $table->string('paymentType');
            $table->string('paymentStatus');
            $table->decimal('totalPrice');
            $table->timestamps();
            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE orders ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
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
