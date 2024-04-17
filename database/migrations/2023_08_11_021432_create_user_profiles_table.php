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
            $table->dateTime('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->json('numerology')->nullable();
            $table->json('astrology')->nullable();
            $table->json('tarology')->nullable();
            $table->string('sexe', 255)->nullable();
            $table->integer('age')->nullable();
            $table->json('contact')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    // $table->json('astrology') { "date_of_birth": "15/01/1991", "time_of_birth": "10:00", "city_of_birth": "perpignan", "native_country": "france" }


    // {"lifePath": 9, "currentYearPath": 5, "lifePathResults": [[9]], "numerologyResults": [[6, 1, 20], [6, 1, 2]], "currentYearResults": [[14], [5]], "numerologyCurrentYearResults": [[6, 1, 7]]}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
