<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
            ->constrained('profiles')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('transaction_type_id')
            ->constrained('transaction_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->bigInteger('mutation');
            $table->bigInteger('balance');
            $table->timestamp('mutate_at', $precision = 0);
            $table->foreignId('income_source_id')
            ->nullable()
            ->constrained('income_sources')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
