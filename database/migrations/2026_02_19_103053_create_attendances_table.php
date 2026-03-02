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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // RKT atau PDM [cite: 85]
            $table->string('category')->default('PDM'); // PDM atau RKT
            $table->string('meeting_name'); // Misal: PDM 1, Rapat Natal 1 [cite: 85]
            $table->enum('status', ['HADIR', 'TANPA KETERANGAN', 'HTA', 'IJIN']); // [cite: 92]
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
