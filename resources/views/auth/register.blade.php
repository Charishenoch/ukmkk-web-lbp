<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-gradient-to-b from-slate-700 to-blue-600 shadow-2xl overflow-hidden sm:rounded-[40px] text-white">
            
            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-xl border border-white/30">
                        <span class="text-2xl font-bold">N</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black leading-none">UKM KK</h2>
                        <p class="text-[10px] tracking-[0.2em] text-blue-200 uppercase font-bold">Tech Support</p>
                    </div>
                </div>
                <h3 class="mt-8 text-xl font-bold text-center">Daftar Akun Baru</h3>
                <p class="text-xs text-gray-300 mt-2">atau <a href="{{ route('login') }}" class="text-yellow-400 font-bold hover:underline">masuk ke akun Anda</a></p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-blue-200 mb-1 ml-1">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-800 border-none focus:ring-4 focus:ring-yellow-400 transition shadow-inner" placeholder="Nama Anda" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-300" />
                </div>

                <div class="mb-5">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-blue-200 mb-1 ml-1">Alamat E-mail</label>
                    <input id="email" type="email" name="email" :value="old('email')" required 
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-800 border-none focus:ring-4 focus:ring-yellow-400 transition shadow-inner" placeholder="user@ukmkk.org" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-300" />
                </div>

                <div class="mb-5">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-blue-200 mb-1 ml-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required 
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-800 border-none focus:ring-4 focus:ring-yellow-400 transition shadow-inner" placeholder="........" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-300" />
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-blue-200 mb-1 ml-1">Konfirmasi Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                        class="block w-full px-4 py-3 rounded-xl bg-white text-gray-800 border-none focus:ring-4 focus:ring-yellow-400 transition shadow-inner" placeholder="........" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-300" />
                </div>

                <button type="submit" class="w-full bg-[#E5E535] hover:bg-yellow-400 text-slate-800 font-black py-4 rounded-xl shadow-lg transform active:scale-95 transition-all flex items-center justify-center space-x-2 uppercase tracking-widest text-sm">
                    <span>Daftar Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-12 mb-8">
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 font-bold italic text-center">
                Bersatu Melayani Tuhan • 2026
            </p>
        </div>
    </div>
</x-guest-layout>