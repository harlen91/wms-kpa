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
        Schema::create('keluar_finish_good', function (Blueprint $table) {
            $table->char('id_finishkeluar', 30)->primary();
            $table->integer('id')->nullable();
            $table->integer('id_circular')->nullable();
            $table->integer('id_cutting')->nullable();
            $table->integer('id_ballpress')->nullable();
            $table->integer('id_specproduk')->nullable();
            $table->integer('id_densitasproduk')->nullable();
            $table->integer('id_denierproduk')->nullable();
            $table->integer('id_warna')->nullable();
            $table->date('tgl_fg')->nullable();
            $table->time('jam_fg')->nullable();
            $table->string('jumlah_ikatan_perikat')->nullable();
            $table->string('jumlah_ikatan_perball')->nullable();
            $table->string('jumlah_tekukan_perikat')->nullable();
            $table->string('jumlah_tali_perikat')->nullable();
            $table->string('jumlah_jahitan_karung_10')->nullable();
            $table->string('panjang_ekor_jahitan')->nullable();
            $table->string('panjang_produk')->nullable();
            $table->string('lebar_produk')->nullable();
            $table->string('angka_densitas_produk')->nullable();
            $table->string('angka_denier_produk')->nullable();
            $table->string('berat_lembar')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluar_finish_good');
    }
};
