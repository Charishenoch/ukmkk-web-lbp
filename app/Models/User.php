<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'batch',
        'role',
        'token_inti',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- TAMBAHKAN RELASI DI BAWAH INI ---

    /**
     * Relasi ke Logbook Tugas (LBP)
     */
    public function tasks()
    {
        return $this->hasMany(Task::class); // Satu pengurus punya banyak tugas [cite: 74]
    }

    /**
     * Relasi ke Presensi (Monev Kehadiran)
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class); // Satu pengurus punya banyak record kehadiran
    }
}
