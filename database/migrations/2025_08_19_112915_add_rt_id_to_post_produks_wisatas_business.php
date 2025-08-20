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
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('rt_id')->nullable();
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->integer('rt_id')->nullable();
        });

        Schema::table('wisatas', function (Blueprint $table) {
            $table->integer('rt_id')->nullable();
        });

        Schema::table('businesses', function (Blueprint $table) {
            $table->integer('rt_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_produks_wisatas_business', function (Blueprint $table) {
            //
        });
    }
};
