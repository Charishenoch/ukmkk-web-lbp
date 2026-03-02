<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\JoblistDefault;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        // Bersihin data lama biar gak numpuk
        User::truncate();
        Project::truncate();
        JoblistDefault::truncate();
        Task::truncate();

        // 1. Buat Akun Lo (Superadmin)
        $charis = User::create([
            'name' => 'Charis Henoch',
            'email' => 'charis@ukmkk.test',
            'password' => Hash::make('password123'),
            'batch' => 1,
            'role' => 'superadmin',
        ]);

        // 2. Buat Proker RKT
        $natal = Project::create([
            'nama_proker' => 'NATAL 2025',
            'departemen' => 'INTERNAL',
            'tanggal' => '2025-12-25',
        ]);

        // 3. Isi Joblist Default (Menu yang bakal di-PICK user)
        JoblistDefault::create([
            'project_id' => $natal->id,
            'sie_name' => 'PDD',
            'deskripsi_tugas' => 'Desain Banner Utama 5x3m',
        ]);

        JoblistDefault::create([
            'project_id' => $natal->id,
            'sie_name' => 'PDD',
            'deskripsi_tugas' => 'Edit Video Teaser Natal',
        ]);

        JoblistDefault::create([
            'project_id' => $natal->id,
            'sie_name' => 'KONSUMSI',
            'deskripsi_tugas' => 'Cari Vendor Katering 200 Pax',
        ]);

        // 4. Kasih 1 Tugas contoh yang udah "diambil" (LBP Aktif)
        Task::create([
            'project_id' => $natal->id,
            'user_id' => $charis->id,
            'pemberi_tugas' => 'Admin',
            'deskripsi_tugas' => 'Booking Gedung Serbaguna',
            'deadline' => now()->addDays(5),
            'status' => 'PENGERJAAN',
            'is_imported' => true,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}