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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Orang yang ngerjain [cite: 21]
            $table->foreignId('validator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('pemberi_tugas'); // Kolom 'Input' di PDF lo [cite: 42]
            $table->string('deskripsi_tugas'); // [cite: 40]
            $table->date('deadline'); // [cite: 44]
            $table->enum('status', ['PENGERJAAN','SELESAI','TIDAK SELESAI'])->default('PENGERJAAN'); // [cite: 46]
            $table->text('keterangan')->nullable(); // [cite: 48]
            $table->enum('output', ['BAIK','CUKUP','KURANG'])->nullable();
            $table->integer('output_score')->default(0); // Skor: 3, 2, atau 0 [cite: 79, 81, 83]
            $table->boolean('is_imported')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
