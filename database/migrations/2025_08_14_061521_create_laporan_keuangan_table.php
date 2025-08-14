<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_transaksi');
            $table->decimal('pemasukan', 15, 2)->nullable();
            $table->decimal('pengeluaran', 15, 2)->nullable();
            $table->string('bulan');
            $table->string('bulan');
            $table->string('tahun');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
