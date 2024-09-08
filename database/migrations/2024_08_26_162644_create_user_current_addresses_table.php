<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_current_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('latitude');
            $table->string('longitude');
            $table->uuid('customer_id');
            $table->boolean('is_current_address')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_current_addresses');
    }
};
