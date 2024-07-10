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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->string('sku', 60);
            $table->string('nama', 191);
            $table->string('foto', 191)->nullable();
            $table->string('jenis', 100);
            $table->string('satuan', 50);
            $table->string('berat', 20)->nullable();
            $table->string('link', 150)->nullable();
            $table->text('deskripsi');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
