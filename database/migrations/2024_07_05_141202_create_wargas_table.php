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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('kk_id', 40);
            $table->string('nik', 30)->unique();
            $table->string('nama', 60);
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 150);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu']);
            $table->integer('rt_id');
            $table->integer('rw_id');
            $table->integer('dusun_id');
            $table->string('pendidikan', 60)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('ayah', 100)->nullable();
            $table->string('ibu', 100)->nullable();
            $table->string('foto', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
