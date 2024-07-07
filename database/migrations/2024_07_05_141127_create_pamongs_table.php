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
        Schema::create('pamongs', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nip', 25)->nullable();
            $table->string('gelar_depan', 20)->nullable();
            $table->string('gelar_belakang', 20)->nullable();
            $table->string('nama', 100);
            $table->string('foto', 191)->nullable();
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 60);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu']);
            $table->string('alamat', 191);
            $table->string('hp', 16);
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pamongs');
    }
};
