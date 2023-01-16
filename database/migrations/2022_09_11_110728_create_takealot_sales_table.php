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
        Schema::create('takealot_sales', function (Blueprint $table) {
            $table->id();
            $table->string('tsin');
            $table->string('order_item_id');
            $table->string('order_id');
            $table->string('order_date');
            $table->string('order_time');
            $table->string('product_name');
            $table->string('selling_price');
            $table->string('quantity');
            $table->string('sale_status');
            $table->string('cust_name');
            $table->string('dc');
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
        Schema::dropIfExists('takealot_sales');
    }
};
