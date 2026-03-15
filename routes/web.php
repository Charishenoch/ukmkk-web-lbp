<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Halaman utama biarin aja welcome kalau mau, 
// tapi kalau mau langsung login bisa pake redirect atau tetep ke welcome.
Route::get('/', function () {
    return view('welcome');
});

// Bungkus Dashboard & Input Task pake Middleware 'auth' & 'verified'
// Artinya: Cuma yang udah login yang bisa masuk sini.
// Bungkus Dashboard & Input Task pake Middleware 'auth' & 'verified'
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Dashboard User Biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // --- TAMBAHKAN RUTE DASHBOARD ADMIN DI SINI ---
    Route::get('/dashboard_admin', [DashboardController::class, 'adminIndex'])->name('dashboard_admin');
    
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    
    // Proker Routes
    Route::get('/proker', [ProjectController::class, 'index'])->name('proker.index');
    Route::get('/proker/create', [ProjectController::class, 'create'])->name('proker.create');
    Route::post('/proker', [ProjectController::class, 'store'])->name('proker.store');
    Route::get('/proker/{project}', [ProjectController::class, 'show'])->name('proker.show');
    
    // Joblist Routes
    Route::get('/proker/{id}/joblist', [ProjectController::class, 'joblist'])->name('proker.joblist');
    Route::post('/joblist/{id}/pick', [ProjectController::class, 'pickJob'])->name('joblist.pick');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';