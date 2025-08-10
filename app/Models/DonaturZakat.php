<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonaturZakat extends Model
{
    protected $table = 'donatur_zakats';

    protected $fillable = [
        'nama',
        'tanggal',
        'jumlah',
        'jenis_zakat_id',
        'metode',
        'bukti',
        'status',
    ];

    public function jenisZakat()
    {
        return $this->belongsTo(JenisZakat::class, 'jenis_zakat_id');
    }
}
