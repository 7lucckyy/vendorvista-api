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
            $table->uuid('id');
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address');
            $table->dateTime('email_address_verified_at')->nullable();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->string('nin_number')->nullable();
            $table->string('user_type');
            $table->timestamps();
            $table->softDeletes();
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
