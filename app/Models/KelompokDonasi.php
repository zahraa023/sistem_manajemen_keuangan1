<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokDonasi extends Model
{
    protected $table = 'kelompok_donasi';

    protected $fillable = [
        'judul', 'target', 'terkumpul', 'galeri'
    ];
}
