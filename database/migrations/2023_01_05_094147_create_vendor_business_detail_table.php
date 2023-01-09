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
        Schema::create('vendor_business_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('shop_name');
            $table->string('shop_address');
            $table->string('shop_city');
            $table->string('shop_country');
            $table->string('shop_state');
            $table->string('shop_pincode');
            $table->string('shop_mobile');
            $table->string('shop_email');
            $table->string('business_license_number');
            $table->string('address_proof');
            $table->string('gst_number');
            $table->string('pen_number');
            $table->string('address_proof_image');
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
        Schema::dropIfExists('vendor_business_detail');
    }
};
