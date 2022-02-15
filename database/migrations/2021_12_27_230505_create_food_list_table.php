<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_list', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->integer('price');
            $table->string('img_url');
            $table->string('type');
            $table->string('created_at')->timestamps();
            $table->string('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_list');
    }
}
