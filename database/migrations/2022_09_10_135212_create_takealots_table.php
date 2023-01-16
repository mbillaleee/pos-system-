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
        Schema::create('takealots', function (Blueprint $table) {
            $table->id();
            $table->string('tsin');
            $table->string('offer_id');
            $table->string('title');
            $table->string('selling_price');
            $table->string('rrp');
            $table->string('quantity');
            $table->string('sku');
            $table->string('barcode');
            $table->string('status');
            $table->string('takealot_url');
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
        Schema::dropIfExists('takealots');
    }
};
