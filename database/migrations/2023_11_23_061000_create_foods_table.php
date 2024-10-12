<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {

            $table->id();
            $table->string('food_name', 255)->required();
            $table->string('food_brief_description', 100)->required();
            $table->string('food_full_description', 255)->required();
            $table->foreignId('category_id')->required();
            $table->integer('food_price')->required();
            $table->string('food_image', 255)->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
};
