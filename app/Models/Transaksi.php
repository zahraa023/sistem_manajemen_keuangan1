<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nama_transaksi',
        'pemasukan',
        'pengeluaran',
    ];

    public $timestamps = true; // untuk created_at dan updated_at
}
