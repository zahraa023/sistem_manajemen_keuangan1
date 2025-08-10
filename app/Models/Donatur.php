<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donaturs'; // Sesuaikan nama tabel di database

    protected $fillable = [
        'nama',
        'tanggal',
        'jumlah',
        'metode',
        'bukti',
        'status',
        // jika ada foreign key jenis zakat, tambahkan juga misal: 'jenis_zakat_id',
    ];

    // Jika ingin relasi dengan model JenisZakat, contoh:
    public function jenisZakat()
    {
        return $this->belongsTo(JenisZakat::class, 'jenis_zakat_id');
    }
}
