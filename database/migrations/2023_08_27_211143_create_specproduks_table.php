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
        Schema::create('specproduk', function (Blueprint $table) {
            $table->increments('id_specproduk');
            $table->string('nama_specproduk')->nullable();
            $table->string('panjang')->nullable();
            $table->string('lebar')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specproduks');
    }
};
