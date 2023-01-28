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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->date('start_date');
            $table->string('currency');
            $table->string('upload_logo')->nullable();
            $table->string('website')->nullable();
            $table->string('business_contact');
            $table->string('alternate_contact')->nullable();
            $table->string('country');
            $table->string('state')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('land_mark')->nullable();
            $table->string('time_zone');
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
        Schema::dropIfExists('shops');
    }
};
