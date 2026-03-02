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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proker'); // Nama kegiatan [cite: 6]
            $table->string('departemen')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('flyer')->nullable();
            $table->enum('calculation_type', ['LBP', 'PRESENSI'])->default('LBP'); // Cara hitung poin [cite: 87, 89]
            $table->enum('status', ['AKTIF', 'SELESAI'])->default('AKTIF'); 
            $table->date('registration_deadline')->nullable();
            $table->json('kepanitiaan')->nullable(); // Buat nyimpen struktur Sie + Joblist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
