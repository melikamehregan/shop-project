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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamp('first_name')->nullable();
            $table->timestamp('last_name')->nullable();
            $table->string('role');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('avatar')->unique()->nullable();
            $table->string('gender')->unique()->nullable();
            $table->string('password');
            $table->json('metaData')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
