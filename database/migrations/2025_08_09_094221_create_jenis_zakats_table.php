<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisZakatsTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_zakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // kolom nama jenis zakat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_zakats');
    }
}
