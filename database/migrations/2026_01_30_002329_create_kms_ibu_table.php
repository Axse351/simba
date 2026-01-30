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
       Schema::create('kms_ibu', function (Blueprint $table) {
            $table->id();

            // Relasi ke data warga (ibu)
            $table->foreignId('warga_id')
                  ->constrained('wargas')
                  ->onDelete('cascade');

            // Data pemeriksaan
            $table->date('tanggal_pemeriksaan');

            $table->decimal('berat_badan', 5, 2)->nullable(); // kg
            $table->decimal('tinggi_badan', 5, 2)->nullable(); // cm
            $table->decimal('lila', 5, 2)->nullable(); // Lingkar Lengan Atas (cm)

            // IMT bisa dihitung otomatis tapi disimpan untuk histori
            $table->decimal('imt', 5, 2)->nullable();

            $table->enum('status_gizi', [
                'kurang',
                'normal',
                'lebih',
                'obesitas',
                'resiko_kek'
            ])->nullable();

            // Khusus ibu hamil
            $table->integer('usia_kehamilan')->nullable(); // minggu
            $table->string('tekanan_darah')->nullable(); // contoh: 120/80

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kms_ibu');
    }
};
