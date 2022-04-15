<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderFoodListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_food_list', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id')->references('id')->on('order_list');
            $table->string('name');
            $table->integer('price');
            $table->integer('amount');
            $table->string('created_at')->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_food_list');
    }
}
