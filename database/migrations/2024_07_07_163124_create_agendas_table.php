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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->date('mulai');
            $table->date('selesai');
            $table->string('lokasi', 191);
            $table->string('pelaksana', 191)->default('Pemerintah Desa');
            $table->text('deskripsi');
            $table->enum('status', ['rencana', 'proses', 'selesai'])->default('rencana');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
