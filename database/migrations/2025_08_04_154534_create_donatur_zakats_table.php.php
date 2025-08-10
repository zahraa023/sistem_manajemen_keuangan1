<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonaturZakatsTable extends Migration
{
    public function up()
    {
        Schema::create('donatur_zakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->unsignedBigInteger('jenis_zakat_id');
            $table->string('metode');
            $table->string('bukti')->nullable();
            $table->enum('status', ['pending', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('jenis_zakat_id')
                  ->references('id')
                  ->on('jenis_zakats')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donatur_zakats');
    }
}
