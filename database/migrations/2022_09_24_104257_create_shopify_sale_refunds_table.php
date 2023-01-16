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
        Schema::create('shopify_sale_refunds', function (Blueprint $table) {
            $table->id();
            $table->string('sales_id');
            $table->string('refund_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('quantity');
            $table->string('product_total');
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
        Schema::dropIfExists('shopify_sale_refunds');
    }
};
