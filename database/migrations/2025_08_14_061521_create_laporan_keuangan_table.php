<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->date('nama'); 
            $table->decimal('pemasukan', 15, 2)->default(0); // Nominal pemasukan
            $table->decimal('pengeluaran', 15, 2)->default(0); // Nominal pengeluaran
            $table->decimal('saldo', 15, 2)->default(0); // Saldo setelah transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
