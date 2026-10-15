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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->enum('shift', ['A/1', 'A/2', 'A/3', 'B/1', 'B/2', 'B/3', 'C/1', 'C/2', 'C/3'])->nullable();
            $table->enum('role', ['admin', 'gudang']);
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
