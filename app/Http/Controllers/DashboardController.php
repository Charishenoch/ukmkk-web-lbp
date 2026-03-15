<?php

namespace App\Http\Controllers;

use App\Models\Project; // Jangan lupa import model Project-nya!
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Logic Khusus ADMIN
        if ($user->role === 'superadmin') {
            $aktifProker = Project::where('status', 'AKTIF')->get();
            $totalRkt = Project::where('calculation_type', 'LBP')->count();
            $totalNonRkt = Project::where('calculation_type', 'PRESENSI')->count();
            
            // Redirect ke view khusus admin
            return view('dashboard_admin', compact('aktifProker', 'totalRkt', 'totalNonRkt'));
        }

        // 2. Logic Khusus USER (Logic lama lo)
        $user->load(['tasks', 'attendances']);
        $now = now()->startOfDay();

        $reminderDekatDL = $user->tasks->where('status', '!=', 'Selesai')
            ->filter(function($task) use ($now) {
                return $task->deadline && $task->deadline->isFuture() && $task->deadline->diffInDays($now) <= 5;
            });

        $reminderSudahDL = $user->tasks->where('status', '!=', 'Selesai')
            ->filter(function($task) use ($now) {
                return $task->deadline && $task->deadline->isPast() && $task->deadline->diffInDays($now) <= 5;
            });

        $countPdm = $user->attendances->where('category', 'PDM')->where('status', 'HADIR')->count();
        $countRkt = $user->attendances->where('category', 'RKT')->where('status', 'HADIR')->count();
        $totalPoin = $user->tasks->where('status', 'Selesai')->sum('output_score');

        return view('dashboard_user', compact('user', 'totalPoin', 'countPdm', 'countRkt', 'reminderDekatDL', 'reminderSudahDL'));
    }

    public function adminIndex()
    {
        if (auth()->user()->email !== 'admin@ukmkk.org') {
            return redirect()->route('dashboard');
        }

        $aktifProker = \App\Models\Project::where('status', 'AKTIF')->get(); 
        
        // Ambil data lengkap proker RKT & Non-RKT
        $listRkt = \App\Models\Project::where('type', 'rkt')->get();
        $listNonRkt = \App\Models\Project::where('type', 'non-rkt')->get();

        // Hitung totalnya
        $totalRkt = $listRkt->count();
        $totalNonRkt = $listNonRkt->count();

        return view('dashboard_admin', compact(
            'aktifProker', 
            'listRkt', 
            'listNonRkt',
            'totalRkt', 
            'totalNonRkt'
        ));
    }
}