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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variants_id');
            $table->unsignedBigInteger('variants_value_id');
            $table->unsignedBigInteger('product_id');
            $table->double('variant_purchase_price');
            $table->double('variant_sell_price');
            $table->string('variable_image');
            $table->timestamps();
            $table->foreign('product_variants_id')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('variants_value_id')->references('id')->on('values')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
