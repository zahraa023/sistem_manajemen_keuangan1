<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisToDonaturZakatsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donatur_zakats', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn('jenis');

            // Tambah kolom baru
            $table->unsignedBigInteger('jenis_zakat_id')->after('jumlah');
            $table->foreign('jenis_zakat_id')
                  ->references('id')
                  ->on('jenis_zakats')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donatur_zakats', function (Blueprint $table) {
            // Kembalikan kolom lama
            $table->string('jenis');

            // Hapus kolom baru
            $table->dropForeign(['jenis_zakat_id']);
            $table->dropColumn('jenis_zakat_id');
        });
    }
}
