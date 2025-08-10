<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokDonasiTable extends Migration
{
    public function up()
    {
        Schema::create('kelompok_donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');  // misal: Toilet, Karpet
            $table->bigInteger('target');
            $table->bigInteger('terkumpul')->default(0);
            $table->json('galeri')->nullable(); // simpan nama file gambar dalam JSON array
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelompok_donasi');
    }
}
