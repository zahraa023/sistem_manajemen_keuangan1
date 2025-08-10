<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisZakat extends Model
{
    protected $table = 'jenis_zakats';

    protected $fillable = ['nama'];

    // Relasi ke DonaturZakat (jika perlu)
    public function donaturs()
    {
        return $this->hasMany(DonaturZakat::class, 'jenis_zakat_id');
    }
}
