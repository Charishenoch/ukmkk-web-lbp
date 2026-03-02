<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Cek dulu apakah kolom udah ada biar gak error
            $table->string('type')->default('rkt')->after('nama_proker');
            $table->string('tempat')->nullable()->after('tanggal');
            $table->string('link_lokasi')->nullable()->after('tempat');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
