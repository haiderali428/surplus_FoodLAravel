<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email',191)->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('city');
            $table->string('phone_number')->unique();
            $table->string('otp', 6);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

