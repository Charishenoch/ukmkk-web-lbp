<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nama_proker', 
        'departemen', 
        'tanggal', 
        'flyer', 
        'status',
        'kepanitaan',
        'registration_deadline',
        'calculation_type'
    ];    

    public function tasks() 
    {
        return $this->hasMany(Task::class);
    }

    public function joblistDefaults()
    {
        return $this->hasMany(JoblistDefault::class);
    }
}
