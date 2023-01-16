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
        Schema::create('pos_min_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('pos_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_min_price');
            $table->string('product_staus');
            $table->string('tsin')->nullable();
            $table->string('rack_no')->nullable();
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pos_min_prices');
    }
};
