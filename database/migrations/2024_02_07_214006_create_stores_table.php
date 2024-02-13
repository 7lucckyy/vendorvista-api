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
            $table->string('vendor_id')->unique();
            $table->string('store_name')->unique();
            $table->integer('business_type');
            $table->boolean('is_registered');
            $table->string('cac_number')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->longText('business_address');
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
