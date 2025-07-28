<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model
{
    use HasFactory;

    protected $table = 'prayer_times';

    protected $fillable = [
        'date',
        'imsak',
        'fajr',
        'dhuhr',
        'asr',
        'maghrib',
        'isha',
        'location',
    ];
}
