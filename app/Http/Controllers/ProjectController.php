<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\JoblistDefault;
use App\Models\Sie;
use App\Models\ProjectKepanitiaan;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Tampilan Grid Proker
    public function index()
    {
        $projects = Project::all();
        return view('proker.index', compact('projects'));
    }

    // Tampilan Detail Proker (LBP)
    public function show(Project $project)
    {
        $user = auth()->user();
        $myTasks = Task::where('project_id', $project->id)
                        ->where('user_id', $user->id)
                        ->get();

        return view('proker.show', compact('project', 'myTasks'));
    }

    // Tampilan Form Buat Proker
    public function create()
    {
        // Tetap pake data dummy kalau tabel Sie belum ready, 
        // kalau udah ada tabel sies, ganti jadi Sie::all()
        $defaultSies = [
            (object)['id' => 1, 'nama' => 'Ketua Pelaksana'],
            (object)['id' => 2, 'nama' => 'Bendahara'],
            (object)['id' => 3, 'nama' => 'Sekretaris'],
            (object)['id' => 4, 'nama' => 'Publikasi'],
        ];
        
        return view('proker.create', compact('defaultSies'));
    }

    // Logic Simpan Proker & Kepanitiaan
    public function store(Request $request)
    {
        // 1. Simpan Proker Utama
        $project = Project::create([
            'nama_proker' => $request->nama_proker,
            'tanggal' => $request->tanggal,
        ]);

        // 2. Simpan Kepanitiaan (Hanya yang dicentang)
        if ($request->has('selected_sie')) {
            foreach ($request->selected_sie as $sieId) {
                // Ambil joblist untuk Sie ini, kalau kosong kasih array kosong
                $jobs = $request->joblist[$sieId] ?? [];
                
                foreach ($jobs as $job) {
                    // Hanya simpan kalau deskripsi tidak kosong
                    if (!empty(trim($job))) {
                        ProjectKepanitiaan::create([
                            'project_id' => $project->id,
                            'sie_id' => $sieId,
                            'deskripsi_tugas' => trim($job)
                        ]);
                    }
                }
            }
        }

        return redirect()->route('proker.index')->with('success', 'Proker & Joblist berhasil dibuat, lek!');
    }

    public function joblist($id)
    {
        $project = Project::with('joblistDefaults')->findOrFail($id);
        return view('proker.joblist', compact('project'));
    }

    public function pickJob(Request $request, $id)
    {
        $request->validate(['selected_jobs' => 'required|array']);

        foreach ($request->selected_jobs as $jobId) {
            $defaultJob = JoblistDefault::findOrFail($jobId);
            
            Task::create([
                'project_id' => $id,
                'user_id' => auth()->id(),
                'pemberi_tugas' => 'Admin System (Default)',
                'deskripsi_tugas' => $defaultJob->deskripsi_tugas,
                'deadline' => now()->addDays(7),
                'status' => 'PENGERJAAN',
                'is_imported' => true
            ]);
        }

        return redirect()->route('proker.show', $id)->with('success', 'Tugas berhasil di-pick!');
    }
}