<?php
// database/migrations/xxxx_xx_xx_create_discounts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->string('merchant_name');
            $table->string('merchant_email');
            $table->date('onboarding_date');
            $table->string('phone');
            $table->string('pickup_hub');
            $table->string('product_category');
            $table->integer('promised_parcels');
            $table->json('requirements')->nullable();
            $table->json('discount_rules')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
