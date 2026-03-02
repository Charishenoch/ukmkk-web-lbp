<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoblistDefault extends Model
{
    // Kasih izin buat kolom-kolom ini diisi
    protected $fillable = [
        'project_id', 
        'sie_name', 
        'deskripsi_tugas'
    ];

    // Relasi balik ke Project (Satu joblist punya satu project)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}