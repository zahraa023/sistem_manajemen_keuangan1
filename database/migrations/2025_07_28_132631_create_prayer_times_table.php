<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrayerTimesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');                    // Prayer date (e.g., 2025-07-28)
            $table->string('imsak')->nullable();     // Imsak time
            $table->string('fajr')->nullable();      // Fajr (Subuh)
            $table->string('dhuhr')->nullable();     // Dhuhr (Dzuhur)
            $table->string('asr')->nullable();       // Asr (Ashar)
            $table->string('maghrib')->nullable();   // Maghrib
            $table->string('isha')->nullable();      // Isha (Isya)
            $table->string('location')->nullable();  // City or region (optional)
            $table->timestamps();                    // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_times');
    }
}
