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
        Schema::create('my_pos', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('code');
            $table->string('tsin')->nullable();
            $table->string('name');
            $table->string('unit');
            $table->string('cost');
            $table->string('price');
            $table->string('quantity')->nullable();
            $table->string('type');
            $table->string('rack_no')->nullable();
            $table->string('price_group_name')->nullable();
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
        Schema::dropIfExists('my_pos');
    }
};
