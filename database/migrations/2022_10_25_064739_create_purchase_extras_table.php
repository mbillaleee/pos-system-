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
        Schema::create('purchase_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('purchase_variants_id')->nullable();
            $table->unsignedBigInteger('purchase_variants_value_id')->nullable();
            $table->integer('product_type');
            $table->string('quantity');
            $table->string('purchase_price');
            $table->string('total_amount');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('purchase_variants_id')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('purchase_variants_value_id')->references('id')->on('values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_extras');
    }
};
