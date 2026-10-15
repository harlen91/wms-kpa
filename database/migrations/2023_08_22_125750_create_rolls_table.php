<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roll', function (Blueprint $table) {
            $table->char('id_roll', '30')->primary();
            $table->integer('id')->nullable();
            $table->integer('id_machineloom')->nullable();
            $table->integer('id_specroll')->nullable();
            $table->integer('id_kodebenang')->nullable();
            $table->integer('id_lotextruder')->nullable();
            $table->integer('id_circular')->nullable();
            $table->date('tgl_roll')->nullable();
            $table->time('jam_roll')->nullable();
            $table->string('petugas_timbang')->nullable();
            $table->string('operator_ml')->nullable();
            $table->string('denier')->nullable();
            $table->string('densitas')->nullable();
            $table->string('lebar_standart_roll')->nullable();
            $table->string('lebar_aktual_roll')->nullable();
            $table->string('panjang_standart_roll')->nullable();
            $table->string('panjang_aktual_roll')->nullable();
            $table->string('berat_standart_meter')->nullable();
            $table->string('berat_standart_roll')->nullable();
            $table->string('paper_core')->nullable();
            $table->string('brutto')->nullable();
            $table->string('netto')->nullable();
            $table->string('range_berat_masuk_0')->nullable();
            $table->string('range_berat_masuk_3')->nullable();
            $table->string('waste')->nullable();
            $table->string('hasil_perkalian')->nullable();
            $table->text('qrcode_roll')->nullable();
            $table->enum('status_roll', ['Masuk', 'Gagal'])->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolls');
    }
};
