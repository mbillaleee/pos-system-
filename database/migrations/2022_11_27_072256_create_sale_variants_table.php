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
        Schema::create('sale_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('sales_variants_id');
            $table->unsignedBigInteger('sales_variants_value_id');
            $table->integer('quantity');
            $table->string('sell_price');
            $table->string('total_amount');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('sales_variants_id')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('sales_variants_value_id')->references('id')->on('values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_variants');
    }
};
