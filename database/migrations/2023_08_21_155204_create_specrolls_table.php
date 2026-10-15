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
        Schema::create('specroll', function (Blueprint $table) {
            $table->increments('id_specroll');
            $table->string('kode_roll')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('lebar')->nullable();
            $table->string('densitas')->nullable();
            $table->string('denier')->nullable();
            $table->string('standart_panjang')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specrolls');
    }
};
