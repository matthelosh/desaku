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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 191);
            $table->enum('jenis', ['Bumdes', 'Perorangan', 'PT', 'CV', ' Lain']);
            $table->enum('kategori', ['umkm', 'kecil', 'besar'])->default('umkm');
            $table->string('logo', 191)->nullable();
            $table->string('pemilik', 191);
            $table->string('alamat', 191);
            $table->string('kontak', 100);
            $table->string('jml_karyawan', 4);
            $table->float('omzet', 2);
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
