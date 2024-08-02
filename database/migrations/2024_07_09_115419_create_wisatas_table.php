<?php
/**
 * Wisata Migration
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'wisatas',
            function (Blueprint $table) {
                $table->id();
                $table->string('nama', 191);
                $table->string('foto', 191)->nullable();
                $table->string('lokasi', 100);
                $table->string('kategori', 100);
                $table->string('pengelola', 100);
                $table->float('harga_tiket', 2);
                $table->string('buka', 100);
                $table->string('tutup', 100);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
