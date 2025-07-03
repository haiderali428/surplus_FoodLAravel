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
        Schema::table('simple_post', function (Blueprint $table) {
            $table->string('post',255)->nullable()->change();
            // $table->string('image_post',255)->nullable(); // removed to avoid duplicate column
            // $table->string('video_post',255)->nullable(); // removed to avoid duplicate column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simple_post', function (Blueprint $table) {
            //
        });
    }
};
