<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- TAMBAHAN LOGIKA ADMIN OTOMATIS ---
        // Kamu bisa ganti email di bawah ini dengan email admin pilihanmu
        $adminEmail = 'admin@ukmkk.org'; 

        if ($request->email === $adminEmail) {
            // Jika yang login adalah email admin, arahkan ke rute admin
            // Pastikan kamu nanti buat route dengan nama 'admin.dashboard'
            return redirect()->intended(route('dashboard_admin')); 
            // Note: Kalau nanti kamu buat halaman khusus admin, ganti 'dashboard' jadi 'admin.dashboard'
        }
        // --- END LOGIKA ADMIN ---

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}