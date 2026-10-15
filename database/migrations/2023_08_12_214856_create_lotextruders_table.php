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
        Schema::create('lotextruders', function (Blueprint $table) {
            $table->increments('id_lotextruder');
            $table->string('nama_lotextruder')->nullable();
            $table->enum('jenis', ['Stranglinger', 'Longhia'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotextruders');
    }
};
