<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisZakat;

class JenisZakatSeeder extends Seeder
{
    public function run(): void
    {
        // Data jenis zakat yang ingin dipertahankan di database
        $data = [
            ['nama' => 'Zakat Fitrah'],
            ['nama' => 'Zakat Mal'],
            ['nama' => 'Zakat Penghasilan'],
        ];

        // Hapus semua data lama yang tidak ada di daftar ini
        $names = array_column($data, 'nama');
        JenisZakat::whereNotIn('nama', $names)->delete();

        // Tambah atau update data sesuai daftar
        foreach ($data as $item) {
            JenisZakat::updateOrCreate(
                ['nama' => $item['nama']], // kondisi
                $item // data yang diupdate/insert
            );
        }
    }
}
