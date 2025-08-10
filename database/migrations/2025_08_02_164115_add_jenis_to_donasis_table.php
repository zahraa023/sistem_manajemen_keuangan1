<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisToDonasisTable extends Migration
{
    public function up()
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('jenis')->after('metode')->nullable();
        });
    }

    public function down()
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}
