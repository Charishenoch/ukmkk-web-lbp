<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request) {
    \App\Models\Task::create([
        'user_id' => auth()->id(), // Pake ID lo kalau belum login
        'project_id' => $request->project_id ?? 1,
        'pemberi_tugas' => $request->pemberi_tugas,
        'deskripsi_tugas' => $request->deskripsi_tugas,
        'status' => 'Selesai',
        'output_score' => $request->output_score,
        'deadline' => now(),
    ]);
    return back()->with('success', 'Poin berhasil ditambah!');
}
}
