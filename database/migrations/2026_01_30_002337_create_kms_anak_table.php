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
        Schema::create('kms_anak', function (Blueprint $table) {
            $table->id();

            // Relasi ke anak
            $table->foreignId('anak_id')
                ->constrained('anak')
                ->cascadeOnDelete();

            // Waktu pemeriksaan
            $table->date('tanggal_pemeriksaan');
            $table->integer('usia_bulan'); // umur anak saat pemeriksaan

            // Antropometri
            $table->decimal('berat_badan', 5, 2)->nullable(); // kg
            $table->decimal('tinggi_badan', 5, 2)->nullable(); // cm
            $table->decimal('lingkar_kepala', 5, 2)->nullable(); // cm
            $table->decimal('lila', 5, 2)->nullable(); // cm

            // Status gizi (berdasarkan standar WHO)
            $table->enum('status_bb_u', [
                'gizi_buruk',
                'gizi_kurang',
                'gizi_baik',
                'gizi_lebih'
            ])->nullable();

            $table->enum('status_tb_u', [
                'sangat_pendek',
                'pendek',
                'normal',
                'tinggi'
            ])->nullable();

            $table->enum('status_bb_tb', [
                'sangat_kurus',
                'kurus',
                'normal',
                'gemuk'
            ])->nullable();

            // Kesehatan & gizi
            $table->boolean('asi_eksklusif')->nullable();
            $table->boolean('vitamin_a')->nullable();
            $table->string('imunisasi')->nullable(); 
            // contoh: BCG, DPT, Polio, Campak

            $table->text('keluhan')->nullable();
            $table->text('catatan_petugas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kms_anak');
    }
};
