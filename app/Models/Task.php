<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
       protected $fillable = [
        'project_id', 
        'user_id', 
        'validator_id', 
        'pemberi_tugas',
        'deskripsi_tugas', 
        'deadline',
        'status',
        'output', 
        'output_score',
        'registration_deadline',
        'is_imported', 
    ];
        protected $casts = [
        'deadline' => 'datetime',
];
}
