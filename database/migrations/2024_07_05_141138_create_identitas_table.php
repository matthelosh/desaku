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
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pum', 40)->nullable();
            $table->string('nama', 191);
            $table->string('status', 20);
            $table->string('kecamatan', 100);
            $table->string('kode_pos', 100);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->string('luas', 20);
            $table->string('tahun_dibentuk', 20);
            $table->string('bujur', 191);
            $table->string('lintang', 191);
            $table->string('dpl', 30);
            $table->string('telp', 30);
            $table->string('email', 191);
            $table->string('website', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
