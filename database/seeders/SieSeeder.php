<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $sies = ['Ketua Pelaksana', 'Bendahara', 'Sekretaris', 'Publikasi', 'Logistik', 'Acara'];
            foreach ($sies as $sie) {
                \App\Models\Sie::updateOrCreate(['nama' => $sie]);
            }

    }
}
