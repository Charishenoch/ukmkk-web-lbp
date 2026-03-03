<x-guest-layout>
    {{-- Container Utama dengan Background Abu-abu Soft --}}
    <div class="min-h-screen flex flex-col justify-center items-center bg-[#F3F4F6] px-4 py-8 font-sans">
        
        {{-- Card Utama dengan Gradasi Ungu Tua ke Biru (Sesuai GSM) --}}
        <div class="w-full max-w-[400px] rounded-[40px] shadow-2xl overflow-hidden p-10 text-white relative" 
             style="background: linear-gradient(145deg, #524D71 0%, #1F84DA 100%);">
            
            {{-- Ornamen Halus (Opsional: Memberi kesan modern) --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#B9B3D4]/10 rounded-full blur-3xl"></div>

            {{-- Header: Logo & Nama --}}
            <div class="flex items-center justify-center gap-4 mb-10">
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm border border-white/30">
                    <span class="font-black text-2xl">N</span>
                </div>
                <div class="h-10 w-[1.5px] bg-[#B9B3D4]/40"></div>
                <div class="text-left leading-tight">
                    <h1 class="text-2xl font-black tracking-tighter uppercase">UKM KK</h1>
                    <p class="text-[10px] font-bold tracking-[0.2em] text-[#B9B3D4]">TECH SUPPORT</p>
                </div>
            </div>

            {{-- Judul Form --}}
            <div class="text-center mb-8">
                <h2 class="text-xl font-bold tracking-tight">Masuk ke akun Anda</h2>
                <p class="text-xs text-[#B9B3D4] mt-2 tracking-wide font-medium">
                    atau <a href="{{ route('register') }}" class="text-[#E8D621] font-bold hover:underline italic">buat akun baru</a>
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-[#E8D621] font-bold text-xs text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Input Email --}}
                <div class="group">
                    <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 ml-1 text-[#B9B3D4]">
                        Alamat e-mail
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                           class="w-full rounded-2xl border-none bg-white text-[#524D71] py-3.5 px-5 focus:ring-4 focus:ring-[#E8D621]/30 transition-all shadow-lg font-bold placeholder-[#B9B3D4]/50"
                           placeholder="user@ukmkk.org">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-[#E8D621] font-bold" />
                </div>

                {{-- Input Password --}}
                <div class="group">
                    <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 ml-1 text-[#B9B3D4]">
                        Kata sandi
                    </label>
                    <input id="password" type="password" name="password" required
                           class="w-full rounded-2xl border-none bg-white text-[#524D71] py-3.5 px-5 focus:ring-4 focus:ring-[#E8D621]/30 transition-all shadow-lg font-bold placeholder-[#B9B3D4]/50"
                           placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-[#E8D621] font-bold" />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between px-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" 
                               class="rounded border-none text-[#1F84DA] focus:ring-0 w-4 h-4 shadow-sm bg-white/20">
                        <span class="ms-2 text-[11px] font-bold text-[#B9B3D4] group-hover:text-white transition-colors lowercase">{{ __('ingat saya') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-[10px] font-bold text-[#B9B3D4] hover:text-[#E8D621] transition-colors italic" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>

                {{-- Tombol Masuk (Kuning GSM) --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full py-4 rounded-2xl font-black uppercase text-sm tracking-[0.2em] transition-all 
                                   bg-[#E8D621] hover:bg-[#d6c51e] text-[#524D71] shadow-xl shadow-black/20 
                                   hover:scale-[1.02] active:scale-95 flex justify-center items-center group">
                        {{ __('Masuk') }}
                        <svg class="w-4 h-4 ms-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer Branding --}}
        <div class="mt-10 text-center">
            <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.5em] italic opacity-60">
                Bersatu Melayani Tuhan • 2026
            </p>
        </div>
    </div>
</x-guest-layout>