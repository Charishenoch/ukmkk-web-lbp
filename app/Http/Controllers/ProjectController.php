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
    public function index(Request $request)
    {
        $type = $request->query('type', 'rkt'); 
        $projects = Project::where('type', $type)->get();
        
        return view('proker.index', compact('projects', 'type'));
    }

    // Tampilan Detail Proker (LBP)
    public function show(Project $project)
    {
        // Gunakan query yang cuma ambil unique sie_id untuk project ini
        $project->load(['sies' => function($query) {
            $query->distinct('sies.id');
        }]);

        $myTasks = Task::where('project_id', $project->id)->get();
        return view('proker.show', compact('project', 'myTasks'));
    }

    // Tampilan Form Buat Proker
    public function create(Request $request)
    {
        $type = $request->query('type', 'rkt'); // Nangkep tipe dari URL
        // Tetap pake data dummy kalau tabel Sie belum ready, 
        // kalau udah ada tabel sies, ganti jadi Sie::all()
        $defaultSies = [
            (object)['id' => 1, 'nama' => 'Ketua Pelaksana'],
            (object)['id' => 2, 'nama' => 'Bendahara'],
            (object)['id' => 3, 'nama' => 'Sekretaris'],
            (object)['id' => 4, 'nama' => 'Publikasi'],
        ];
        
        return view('proker.create', compact('defaultSies','type'));
    }

    // Logic Simpan Proker & Kepanitiaan
    public function store(Request $request)
    {
        // Handle File Upload
        $flyerPath = null;
        if ($request->hasFile('flyer')) {
            $flyerPath = $request->file('flyer')->store('flyers', 'public');
        }    

        // 1. Simpan Proker Utama
        $project = Project::create([
            'nama_proker' => $request->nama_proker,
            'tanggal'     => $request->tanggal,
            'type'        => $request->type,
            'jenis'       => $request->jenis,
            'departemen'  => $request->departemen,
            'tempat'      => $request->tempat,
            'link_lokasi' => $request->link_lokasi,
            'flyer'       => $flyerPath,
        ]);

        // 2. Simpan Kepanitiaan (Hanya yang dicentang)
        if ($request->type === 'rkt' && $request->has('selected_sie')) {
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

        return redirect()->route('proker.index', ['type' => $request->type])->with('success', 'Proker & Joblist berhasil dibuat, lek!');
    }

    public function joblist(Request $request, $id)
    {
        $sieId = $request->query('sie_id');
        $project = Project::findOrFail($id);
        
        // Tarik data tugas dari tabel yang bener (ProjectKepanitiaan)
        $query = ProjectKepanitiaan::where('project_id', $id);
        
        // Kalau URL punya parameter ?sie_id=X, kita filter tugasnya
        if ($sieId) {
            $query->where('sie_id', $sieId);
        }
        
        $jobs = $query->get(); // Eksekusi query
        
        // Ambil nama Sie buat ditampilin cantik di header (kalau ada sie yang dipilih)
        $selectedSie = $sieId ? Sie::find($sieId) : null;

        return view('proker.joblist', compact('project', 'jobs', 'selectedSie'));
    }

    public function pickJob(Request $request, $id)
    {
        $request->validate(['selected_jobs' => 'required|array']);

        foreach ($request->selected_jobs as $jobId) {
            // Ambil detail tugas dari tabel ProjectKepanitiaan
            $kepanitiaanJob = ProjectKepanitiaan::findOrFail($jobId);
            
            Task::create([
                'project_id' => $id,
                'user_id' => auth()->id(),
                'pemberi_tugas' => 'Admin System',
                'deskripsi_tugas' => $kepanitiaanJob->deskripsi_tugas, // Ngambil dari sini
                'deadline' => now()->addDays(7),
                'status' => 'PENGERJAAN',
                'is_imported' => true
            ]);
        }

        return redirect()->route('proker.show', [
            'project' => $id,
            'sie_id' => $request->sie_id
        ])->with('success', 'Tugas berhasil di-pick!');
    }
}