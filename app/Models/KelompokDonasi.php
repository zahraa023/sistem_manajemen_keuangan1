<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokDonasi extends Model
{
    protected $table = 'kelompok_donasi';

    protected $fillable = [
        'nama_kelompok',
        'target',
        'terkumpul',
        'galeri',
    ];

    protected $casts = [
        'galeri' => 'array', // otomatis decode/encode JSON ke array
    ];
}
