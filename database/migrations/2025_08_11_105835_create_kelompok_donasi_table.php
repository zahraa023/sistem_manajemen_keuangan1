<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kelompok_donasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->bigInteger('target');
            $table->bigInteger('terkumpul')->default(0);
            $table->string('galeri')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelompok_donasi');
    }
};
