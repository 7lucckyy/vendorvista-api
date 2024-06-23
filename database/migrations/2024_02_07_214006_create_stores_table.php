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
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('customer_id')->unique()->index();
            $table->string('store_name')->unique();
            $table->boolean('is_registered')->nullable();
            $table->string('cac_number')->nullable();
            $table->string('business_phone_number')->nullable();
            $table->string('business_category')->nullable();
            $table->string('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('cac_certificate_path')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->longText('business_address')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('stores');
    }
};
