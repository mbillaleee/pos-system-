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
        Schema::create('shopify_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('sales_id');
            $table->string('sales_date');
            $table->string('cust_firstname')->nullable();
            $table->string('cust_lastname')->nullable();
            $table->string('total_amount');
            $table->string('sales_status');
            $table->string('payment_method')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address1')->nullable();
            $table->string('shipping_address2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address1')->nullable();
            $table->string('billing_address2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_province')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('collectno')->nullable();
            $table->string('waybillno')->nullable();
            $table->string('booking_status')->nullable();
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
        Schema::dropIfExists('shopify_sales');
    }
};
