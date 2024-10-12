<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->string('transaction_id');
            $table->foreignId("user_id")->nullable(false);
            $table->string("full_name")->nullable(false);
            $table->string("phone_number")->nullable(false);
            $table->string("address")->nullable(false);
            $table->string("city")->nullable(false);
            $table->string("card_holder_name")->nullable(false);
            $table->string("card_number")->nullable(false);
            $table->string("country")->nullable(false);
            $table->string("zip_code")->nullable(false);
            $table->timestamps();
            $table->primary('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_headers');
    }
};
