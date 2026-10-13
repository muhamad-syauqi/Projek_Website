<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Tanggal acara/foto, dipakai untuk filter bulan di halaman Galeri
            $table->date('taken_at')->nullable()->after('description');
        });

        // Foto yang sudah ada: pakai tanggal upload sebagai tanggal awal
        DB::table('galleries')
            ->whereNull('taken_at')
            ->update(['taken_at' => DB::raw('DATE(created_at)')]);
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('taken_at');
        });
    }
};