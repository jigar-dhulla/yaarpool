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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('bio', 1024);
            $table->string('occupation')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('has_vehicle');
            $table->boolean('four_wheeler')->nullable();
            $table->boolean('twitter_url')->nullable();
            $table->boolean('linkedin_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
