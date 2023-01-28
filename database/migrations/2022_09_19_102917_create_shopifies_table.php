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
        Schema::create('shopifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('product_id');
            $table->string('variants_id');
            $table->string('title');
            $table->string('regular_price')->nullable();
            $table->string('price');
            $table->string('qty');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->longText('description');
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopifies');
    }
};
