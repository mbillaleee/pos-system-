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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_id')->nullable();
            $table->string('name');
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->string('barcode_type')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('image', 2000)->nullable();
            $table->string('product_boosear', 2000)->nullable();
            $table->integer('unit')->nullable();
            $table->string('model_no')->nullable();
            $table->string('rack_no')->nullable();
            $table->string('alert_query')->nullable();
            $table->longText('description')->nullable();
            $table->string('weight')->nullable();
            $table->integer('product_type');
            $table->double('sell_price', 20, 2)->index('unit_price');
            $table->double('purchase_price', 20, 2)->nullable();
            $table->integer('status')->default(1)->comment('Active=1, Inactive=0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
