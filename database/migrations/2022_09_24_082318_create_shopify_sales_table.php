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
            $table->string('sales_id');
            $table->string('sales_date');
            $table->string('cust_firstname');
            $table->string('cust_lastname');
            $table->string('total_amount');
            $table->string('sales_status');
            $table->string('payment_method');
            $table->string('shipping_name');
            $table->string('shipping_address1');
            $table->string('shipping_address2');
            $table->string('shipping_city');
            $table->string('shipping_province');
            $table->string('shipping_country');
            $table->string('shipping_zip');
            $table->string('shipping_phone');
            $table->string('billing_name');
            $table->string('billing_address1');
            $table->string('billing_address2');
            $table->string('billing_city');
            $table->string('billing_province');
            $table->string('billing_country');
            $table->string('billing_zip');
            $table->string('billing_phone');
            $table->string('collectno');
            $table->string('waybillno');
            $table->string('booking_status');
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
        Schema::dropIfExists('shopify_sales');
    }
};
