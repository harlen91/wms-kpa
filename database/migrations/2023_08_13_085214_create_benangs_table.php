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
        Schema::create('benang', function (Blueprint $table) {
            $table->char('id_benang', 30)->primary();
            $table->integer('id_kodebenang')->nullable();
            $table->integer('id_spesifikasi')->nullable();
            $table->integer('id_lotextruder')->nullable();
            $table->integer('id')->nullable();
            $table->string('qty_benang')->nullable();
            $table->date('tgl_benang')->nullable();
            $table->time('jam_benang')->nullable();
            $table->string('bruto')->nullable();
            $table->string('berat_palet')->nullable();
            $table->string('berat_keranjang_satuan')->nullable();
            $table->string('jumlah_keranjang_palet')->nullable();
            $table->string('total_berat_keranjang_palet')->nullable();
            $table->string('berat_bobin_satuan')->nullable();
            $table->string('banyak_bobin_keranjang')->nullable();
            $table->string('total_banyakbobin_palet')->nullable();
            $table->string('total_beratbobin_palet')->nullable();
            $table->string('neto')->nullable();
            $table->string('no_palet')->nullable();
            $table->string('berat_aktual')->nullable();
            $table->text('qrcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benangs');
    }
};
