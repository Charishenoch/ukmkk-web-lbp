<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | UKM KK Official</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #524D71 0%, #1F84DA 100%);
        }
        .text-gradient {
            background: linear-gradient(90deg, #524D71 0%, #1F84DA 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #524D71; border-radius: 10px; }
    </style>
</head>
<body class="bg-white overflow-x-hidden" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <nav :class="scrolled ? 'h-16 bg-white/90 shadow-sm' : 'h-24 bg-transparent'" 
         class="fixed top-0 w-full z-[100] backdrop-blur-md transition-all duration-500 flex items-center px-10 justify-between">
        <div class="flex items-center gap-3">
            <div class="sidebar-gradient p-2 rounded-xl shadow-lg">
                <i class="bi bi-shield-shaded text-white text-xl"></i>
            </div>
            <span :class="scrolled ? 'text-[#524D71]' : 'text-white md:text-[#524D71]'" class="font-black italic text-xl tracking-tighter uppercase transition-colors">UKM KK</span>
        </div>
        <div class="hidden md:flex items-center gap-10 font-black italic text-[10px] uppercase tracking-[0.2em]"
             :class="scrolled ? 'text-gray-400' : 'text-white/70'">
            <a href="#hero" class="hover:text-[#1F84DA] transition-colors">Home</a>
            <a href="#about" class="hover:text-[#1F84DA] transition-colors">Tentang Kami</a>
            <a href="#vision" class="hover:text-[#1F84DA] transition-colors">Visi & Misi</a>
            <a href="#team" class="hover:text-[#1F84DA] transition-colors">Pengurus</a>
        </div>
    </nav>

    <section id="hero" class="min-h-screen sidebar-gradient flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-white rounded-full blur-[150px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-400 rounded-full blur-[150px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        <div class="text-center text-white z-10 px-6" data-aos="zoom-out" data-aos-duration="1500">
            <h1 class="text-7xl md:text-9xl font-black italic uppercase tracking-tighter leading-none mb-6 drop-shadow-2xl">UKM KK</h1>
            <p class="text-xs md:text-sm font-bold uppercase tracking-[0.5em] opacity-80 mb-10">Building Faith, Creativity, and Unity</p>
            <div class="flex justify-center gap-4">
                <a href="#about" class="bg-white text-[#524D71] px-10 py-4 rounded-full font-black uppercase text-[10px] tracking-widest italic hover:bg-[#E8D621] hover:scale-110 transition-all shadow-2xl">Jelajahi Kami</a>
            </div>
        </div>
    </section>

    <section id="about" class="py-32 px-10 overflow-hidden">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-20">
            <div class="md:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                <h4 class="text-gradient font-black italic uppercase tracking-[0.3em] text-xs mb-4">Sejarah Singkat</h4>
                <h2 class="text-5xl font-black italic text-[#524D71] uppercase tracking-tighter mb-8 leading-tight">Berawal dari Semangat Pelayanan.</h2>
                <div class="h-1.5 w-20 bg-[#E8D621] rounded-full mb-8"></div>
                <p class="text-gray-500 font-medium leading-relaxed text-lg">
                    UKM KK dibentuk sebagai wadah bagi seluruh mahasiswa untuk mengeksplorasi potensi diri dalam nilai-nilai kebersamaan. Selama bertahun-tahun, kami telah menjadi rumah kedua bagi ratusan mahasiswa yang ingin berkontribusi bagi kampus dan masyarakat.
                </p>
            </div>
            <div class="md:w-1/2 relative" data-aos="fade-left" data-aos-duration="1000">
                <div class="w-full h-[450px] sidebar-gradient rounded-[60px] shadow-2xl relative overflow-hidden flex items-center justify-center">
                     <i class="bi bi-shield-shaded text-white/10 text-[200px] absolute"></i>
                     <div class="relative z-10 p-10 text-center">
                         <p class="text-white font-black italic text-2xl uppercase tracking-widest">Est. 2020</p>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <section id="vision" class="py-32 bg-gray-50 px-10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-[#524D71] font-black italic text-4xl uppercase tracking-tighter">Visi & Misi Kami</h2>
                <div class="h-1.5 w-20 bg-[#E8D621] rounded-full mx-auto mt-4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white p-12 rounded-[55px] shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-500 group" data-aos="flip-left" data-aos-duration="1000">
                    <div class="w-16 h-16 sidebar-gradient rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform shadow-lg">
                        <i class="bi bi-eye-fill text-2xl"></i>
                    </div>
                    <h3 class="text-[#524D71] font-black italic uppercase text-xl mb-5 tracking-widest">VISI</h3>
                    <p class="text-gray-400 font-medium leading-relaxed italic">"Menjadi komunitas mahasiswa yang berintegritas, kreatif, dan berdampak positif bagi lingkungan universitas."</p>
                </div>
                <div class="bg-white p-12 rounded-[55px] shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-500 group" data-aos="flip-right" data-aos-duration="1000">
                    <div class="w-16 h-16 sidebar-gradient rounded-2xl flex items-center justify-center text-white mb-8 group-hover:rotate-12 transition-transform shadow-lg">
                        <i class="bi bi-rocket-takeoff-fill text-2xl"></i>
                    </div>
                    <h3 class="text-[#524D71] font-black italic uppercase text-xl mb-5 tracking-widest">MISI</h3>
                    <ul class="text-gray-400 font-medium space-y-4">
                        <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-[#1F84DA]"></i> Membangun karakter kepemimpinan yang melayani.</li>
                        <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-[#1F84DA]"></i> Mengembangkan kreativitas di bidang teknologi & seni.</li>
                        <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-[#1F84DA]"></i> Menjalin kerjasama solid antar fakultas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="py-32 px-10">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-[#524D71] font-black italic text-4xl uppercase tracking-tighter mb-20" data-aos="fade-up">Pengurus Inti UKM</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                @for ($i = 1; $i <= 4; $i++)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="w-full aspect-[4/5] bg-gray-100 rounded-[45px] overflow-hidden mb-6 shadow-xl relative border border-gray-50">
                        <div class="absolute inset-0 sidebar-gradient opacity-0 group-hover:opacity-40 transition-opacity duration-500 flex items-center justify-center">
                            <i class="bi bi-instagram text-white text-3xl opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500"></i>
                        </div>
                        <div class="w-full h-full flex items-center justify-center text-[#524D71]/10 font-black italic text-5xl">UKM</div>
                    </div>
                    <h5 class="text-[#524D71] font-black italic uppercase tracking-tighter group-hover:text-[#1F84DA] transition-colors">Nama Pengurus</h5>
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-2 leading-none">Divisi Utama</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <footer class="py-20 sidebar-gradient text-white/50 px-10 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#E8D621] to-transparent"></div>
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex items-center justify-center gap-3 mb-8 opacity-80" data-aos="zoom-in">
                <i class="bi bi-shield-shaded text-2xl text-white"></i>
                <span class="font-black italic text-white text-xl tracking-tighter uppercase leading-none">UKM KK</span>
            </div>
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] mb-10">© 2026 IT SUPPORT UKMKK - ALL RIGHTS RESERVED</p>
            
            <div class="flex justify-center gap-8 text-[9px] font-black italic uppercase tracking-widest">
                <a href="#" class="hover:text-white transition-colors">Information Services</a>
                <a href="{{ route('login') }}" class="hover:text-yellow-300 transition-colors">Core System Access</a>
                <a href="{{ route('register') }}" class="hover:text-yellow-400 transition-colors">Documentation</a>
            </div>
        </div>
    </footer>

    <script>
        // Inisialisasi AOS
        AOS.init({
            once: false, // Animasi jalan terus tiap scroll
            mirror: true
        });
    </script>
</body>
</html>