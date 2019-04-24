<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number');
            $table->string('user_email', 200);
            $table->bigInteger('designer_id')->nullable();
            $table->bigInteger('background_id')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->integer('status')->default(1);
            $table->string('order_id');
            $table->decimal('price',10,2)->nullable();
            $table->string('shopify_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
