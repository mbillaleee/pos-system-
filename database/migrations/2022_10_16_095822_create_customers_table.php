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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('price_group_id');
            $table->string('tax_number')->nullable();
            $table->float('opening_balance');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('zip_code');
            $table->integer('status')->default(1)->comment('Active=1, Inactive=0');
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('price_group_id')->references('id')->on('price_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
