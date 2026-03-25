@extends('layouts.main')

@section('title', '2D & 3D Animation Agency - Lund\'or Imagine Digital')

@section('content')
<!-- Mengambil font khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<style>
    .font-space { font-family: 'Space Grotesk', sans-serif; }

    /* Scrollbar Modal */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #05050a; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #9d00ff; border-radius: 3px; }

    /* Efek Outline untuk Kinetic Typography */
    .text-outline {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.15);
        transition: color 0.4s ease, -webkit-text-stroke-color 0.4s ease;
    }
    .text-outline:hover {
        color: #9d00ff;
        -webkit-text-stroke: 0px transparent;
    }
    @media (min-width: 768px) {
        .text-outline {
            -webkit-text-stroke: 2px rgba(255, 255, 255, 0.15);
        }
    }
    .will-change-transform { will-change: transform; }

    /* Glass Card untuk Bento Grid (Diperterang) */
    .glass-card {
        background: rgba(255, 255, 255, 0.08); /* Dibuat lebih terang */
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.15); /* Border lebih jelas */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.12); /* Efek hover lebih terang */
        border-color: rgba(249, 0, 91, 0.4);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(249, 0, 91, 0.15);
    }

    /* Pipeline Line Gradient */
    .pipeline-line {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 2rem;
        width: 1px;
        background: linear-gradient(to bottom, transparent, #f9005b, #9d00ff, #f9005b, transparent);
        z-index: 0;
    }
    @media (min-width: 768px) {
        .pipeline-line { left: 50%; transform: translateX(-50%); }
    }

    /* Showcase Image Hover */
    .showcase-img {
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.5s ease;
        filter: grayscale(40%) brightness(0.9); /* Dibuat lebih terang dari sebelumnya */
    }
    .group:hover .showcase-img {
        transform: scale(1.05);
        filter: grayscale(0%) brightness(1.1);
    }

    /* Marquee Software Stack */
    .marquee-wrapper { overflow: hidden; white-space: nowrap; position: relative; }
    .marquee-wrapper::before, .marquee-wrapper::after {
        content: ''; position: absolute; top: 0; width: 150px; height: 100%; z-index: 2;
    }
    .marquee-wrapper::before { left: 0; background: linear-gradient(to right, #05050a 0%, transparent 100%); }
    .marquee-wrapper::after { right: 0; background: linear-gradient(to left, #05050a 0%, transparent 100%); }
    .marquee-content { display: inline-flex; animation: scroll-marquee 40s linear infinite; width: max-content; }
    @keyframes scroll-marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* Custom Video Player di Modal */
    video::-webkit-media-controls-panel {
        background-image: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    }
</style>

<!-- 1. HERO SECTION (Video Game deemo.mp4) -->
<section id="hero-animation" class="relative w-full min-h-screen flex items-center justify-center bg-[#05050a] overflow-hidden pt-20 border-b border-white/5">
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-lighten z-0">
        <source src="{{ asset('assets/video/Game deemo.mp4') }}" type="video/mp4">
    </video>
    
    <div class="absolute inset-0 bg-gradient-to-b from-[#05050a]/40 via-[#05050a]/20 to-[#05050a] z-0 pointer-events-none"></div>

    <div class="relative z-10 text-center px-6 w-full max-w-5xl mx-auto flex flex-col items-center">
        <div class="mb-6 inline-flex items-center gap-3 px-5 py-2 rounded-full border border-[#f9005b]/30 bg-[#f9005b]/10 backdrop-blur-md shadow-[0_0_20px_rgba(249,0,91,0.1)]">
            <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse"></span>
            <span class="text-xs md:text-sm font-mono text-[#f9005b] tracking-[0.2em] uppercase">Creative Animation Agency</span>
        </div>

        <h1 class="text-5xl md:text-7xl lg:text-[8rem] text-white mb-6 leading-[1.1] drop-shadow-2xl" style="font-family: 'Lobster', cursive;">
            Unleashing <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] via-[#ff0055] to-[#9d00ff]">Imagination.</span>
        </h1>

        <p class="text-sm md:text-lg text-gray-400 font-sans max-w-3xl mx-auto leading-relaxed font-light mt-4 shadow-black drop-shadow-lg">
            Kami adalah studio animasi 2D & 3D yang berdedikasi membantu brand Anda tampil memukau. Dari iklan komersial yang memikat, visualisasi produk, hingga video explainer, kami mengubah ide kompleks menjadi visual tak terlupakan.
        </p>

        <div class="mt-16 opacity-50 flex flex-col items-center gap-3">
            <span class="text-[10px] font-mono uppercase tracking-[0.3em] text-gray-400">See Our Work</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-gray-400 to-transparent"></div>
        </div>
    </div>
</section>

<!-- 1.5 KINETIC TYPOGRAPHY TRANSITION -->
<section id="kinetic-animation" class="py-24 bg-[#05050a] relative overflow-hidden flex flex-col justify-center min-h-[50vh] z-30 border-b border-white/5">
    <div class="absolute inset-0 pointer-events-none bg-gradient-to-r from-[#05050a] via-transparent to-[#05050a] z-10 w-full h-full"></div>
    <div class="flex flex-col gap-2 md:gap-4 transform rotate-2 scale-105">
        <div class="kinetic-row marquee-left flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[9rem] font-black uppercase tracking-tighter w-max will-change-transform font-space" style="transform: translateX(-10%);">
            <span class="kinetic-word text-outline">Simulate.</span>
            <span class="kinetic-word text-outline">Simulate.</span>
            <span class="kinetic-word text-outline">Simulate.</span>
            <span class="kinetic-word text-outline">Simulate.</span>
            <span class="kinetic-word text-outline">Simulate.</span>
        </div>
        <div class="kinetic-row marquee-right flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[9rem] font-black uppercase tracking-tighter w-max will-change-transform font-space" style="transform: translateX(-25%);">
            <span class="kinetic-word text-outline">Animate.</span>
            <span class="kinetic-word text-outline">Animate.</span>
            <span class="kinetic-word text-outline">Animate.</span>
            <span class="kinetic-word text-outline">Animate.</span>
            <span class="kinetic-word text-outline">Animate.</span>
        </div>
        <div class="kinetic-row marquee-left flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[9rem] font-black uppercase tracking-tighter w-max will-change-transform font-space" style="transform: translateX(-5%);">
            <span class="kinetic-word text-outline">Fascinate.</span>
            <span class="kinetic-word text-outline">Fascinate.</span>
            <span class="kinetic-word text-outline">Fascinate.</span>
            <span class="kinetic-word text-outline">Fascinate.</span>
            <span class="kinetic-word text-outline">Fascinate.</span>
        </div>
    </div>
</section>

<!-- 2. CAPABILITIES BENTO GRID (Semua Aset Dipakai Di Sini) -->
<section class="py-24 md:py-32 bg-[#05050a] relative z-20">
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-left mb-16 max-w-3xl">
            <p class="font-mono text-[#f9005b] text-xs tracking-[0.3em] uppercase mb-4">/// Our Animation Services</p>
            <h2 class="text-4xl md:text-6xl font-space font-bold text-white uppercase tracking-tighter mb-6">
                Comprehensive Visual <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#9d00ff] to-[#f9005b]">Solutions</span>
            </h2>
            <p class="text-gray-400 font-light text-sm md:text-base leading-relaxed">Dari kampanye digital berskala besar hingga konten media sosial yang interaktif, tim kami siap memproduksi aset animasi berkualitas tinggi untuk mendongkrak nilai bisnis Anda.</p>
        </div>

        <!-- BENTO GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[350px]">
            
            <!-- Card 1: 3D Product Visualization (lipstick1.png) -->
            <div class="glass-card md:col-span-2 row-span-1 rounded-[2rem] overflow-hidden relative group p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 gs-reveal">
                <div class="absolute inset-0 bg-gradient-to-r from-white/5 to-transparent z-0"></div> <!-- Overlay diperterang -->
                <div class="relative z-10 md:w-1/2 flex flex-col justify-center h-full">
                    <span class="px-3 py-1 bg-white/10 border border-white/30 text-white text-[10px] font-mono tracking-widest rounded-full w-max mb-4">01 // 3D PRODUCT COMMERCIALS</span>
                    <h3 class="text-3xl md:text-4xl font-space font-bold text-white mb-4 uppercase tracking-tight">Product <br>Commercials</h3>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Tingkatkan daya tarik produk Anda dengan visualisasi 3D yang fotorealistik. Sempurna untuk memamerkan detail produk di iklan TV, peluncuran produk baru, hingga materi presentasi bisnis.
                    </p>
                </div>
                <div class="relative z-10 md:w-1/2 h-full w-full flex items-center justify-center">
                    <img src="{{ asset('assets/images/lipstick1.png') }}" alt="3D Product Render" class="h-full object-contain drop-shadow-[0_20px_30px_rgba(249,0,91,0.4)] group-hover:scale-110 transition-transform duration-700">
                </div>
            </div>

            <!-- Card 2: Gaming & Character (1221.mp4) -->
            <div class="glass-card col-span-1 row-span-2 rounded-[2rem] overflow-hidden relative group gs-reveal">
                <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-700 filter grayscale-[30%] group-hover:grayscale-0">
                    <source src="{{ asset('assets/video/1221.mp4') }}" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/80 via-[#05050a]/20 to-transparent z-0"></div> <!-- Gradien dibuat lebih terang -->
                <div class="relative z-10 h-full p-8 flex flex-col justify-end">
                    <span class="px-3 py-1 bg-[#9d00ff]/30 border border-[#9d00ff]/50 text-white text-[10px] font-mono tracking-widest rounded-full w-max mb-4 backdrop-blur-md">02 // CHARACTERS & MASCOTS</span>
                    <h3 class="text-2xl md:text-3xl font-space font-bold text-white mb-3 uppercase tracking-tight">Character Animation</h3>
                    <p class="text-gray-200 text-sm leading-relaxed font-light shadow-black drop-shadow-md">
                        Ciptakan maskot brand yang ikonik atau karakter game yang hidup. Kami menangani seluruh proses mulai dari desain karakter, rigging kerangka, hingga animasi penuh gaya.
                    </p>
                </div>
            </div>

            <!-- Card 3: Motion Graphics (0006.png) -->
            <div class="glass-card col-span-1 row-span-1 rounded-[2rem] overflow-hidden relative group p-8 gs-reveal">
                <img src="{{ asset('assets/images/0006.png') }}" alt="Motion Graphics" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700 mix-blend-luminosity">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/90 to-transparent z-0 pointer-events-none"></div>
                <div class="relative z-10 flex flex-col justify-end h-full">
                    <span class="px-3 py-1 bg-white/20 border border-white/40 text-white text-[10px] font-mono tracking-widest rounded-full w-max mb-4 backdrop-blur-md">03 // EXPLAINER VIDEOS</span>
                    <h3 class="text-2xl font-space font-bold text-white mb-2 uppercase">2D Motion Graphics</h3>
                    <p class="text-gray-300 text-xs leading-relaxed font-light">Sampaikan pesan rumit dengan mudah dan estetik. Solusi ideal untuk video tutorial, company profile, dan konten media sosial yang engaging.</p>
                </div>
            </div>

            <!-- Card 4: Environment & VFX (img1.png) -->
            <div class="glass-card col-span-1 row-span-1 rounded-[2rem] overflow-hidden relative group p-8 gs-reveal">
                <img src="{{ asset('assets/images/img1.png') }}" alt="3D Environment" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/90 to-transparent z-0 pointer-events-none"></div>
                <div class="relative z-10 flex flex-col justify-end h-full">
                    <span class="px-3 py-1 bg-white/20 border border-white/40 text-white text-[10px] font-mono tracking-widest rounded-full w-max mb-4 backdrop-blur-md">04 // VIRTUAL ENVIRONMENTS</span>
                    <h3 class="text-2xl font-space font-bold text-white mb-2 uppercase">3D Environments & VFX</h3>
                    <p class="text-gray-300 text-xs leading-relaxed font-light">Bangun dunia virtual tanpa batas. Kami menciptakan latar belakang sinematik untuk film, presentasi arsitektur, hingga aset metaverse.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2.5 SOFTWARE & ENGINE STACK (Marquee Tech) -->
<section class="py-12 bg-[#080815] border-y border-white/10 relative z-20">
    <div class="marquee-wrapper w-full">
        <div class="marquee-content gap-12 px-6">
            <!-- Menampilkan deretan software elit yang digunakan -->
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">UNREAL ENGINE 5</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">BLENDER 3D</h3>
            <span class="text-[#9d00ff] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">CINEMA 4D</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">AUTODESK MAYA</h3>
            <span class="text-[#9d00ff] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">AFTER EFFECTS</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">ZBRUSH</h3>
            <span class="text-[#9d00ff] font-bold">///</span>
            <!-- Ulangi untuk infinite loop -->
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">UNREAL ENGINE 5</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">BLENDER 3D</h3>
            <span class="text-[#9d00ff] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">CINEMA 4D</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">AUTODESK MAYA</h3>
            <span class="text-[#9d00ff] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">AFTER EFFECTS</h3>
            <span class="text-[#f9005b] font-bold">///</span>
            <h3 class="text-2xl font-space font-bold text-gray-600 uppercase tracking-widest">ZBRUSH</h3>
        </div>
    </div>
</section>

<!-- 3. FEATURED VIDEO REELS (Modal Player untuk Video Anda) -->
<section class="py-24 md:py-32 bg-[#05050a] relative z-20 border-b border-white/5">
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Featured Motion Reels</h2>
            <p class="text-gray-400 font-sans mt-2">Saksikan kompilasi karya terbaik kami yang telah membantu klien memenangkan hati audiens.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Video Reel 1 (1221.mp4) -->
            <div class="relative rounded-3xl overflow-hidden bg-white/5 border border-white/15 group aspect-video shadow-2xl gs-reveal cursor-pointer load-media-btn" data-url="{{ asset('assets/video/1221.mp4') }}" data-type="video" data-title="Character & Object Animation Reel">
                <!-- Thumbnail Video (Auto Play muted) -->
                <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                    <source src="{{ asset('assets/video/1221.mp4') }}" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/40 transition-colors duration-500"></div> <!-- Overlay diperterang -->
                
                <div class="absolute inset-0 flex flex-col items-center justify-center z-20">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-[#f9005b]/90 backdrop-blur-md rounded-full flex items-center justify-center text-white transform group-hover:scale-110 transition-transform duration-300 shadow-[0_0_30px_rgba(249,0,91,0.5)]">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <span class="mt-4 font-mono text-white tracking-widest text-xs uppercase font-bold drop-shadow-md">Play Reel 01</span>
                </div>
            </div>

            <!-- Video Reel 2 (Game deemo.mp4) -->
            <div class="relative rounded-3xl overflow-hidden bg-white/5 border border-white/15 group aspect-video shadow-2xl gs-reveal md:translate-y-12 cursor-pointer load-media-btn" data-url="{{ asset('assets/video/Game deemo.mp4') }}" data-type="video" data-title="Environment & Gaming Reel">
                <!-- Thumbnail Video (Auto Play muted) -->
                <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                    <source src="{{ asset('assets/video/Game deemo.mp4') }}" type="video/mp4">
                </video>
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/40 transition-colors duration-500"></div> <!-- Overlay diperterang -->
                
                <div class="absolute inset-0 flex flex-col items-center justify-center z-20">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-[#9d00ff]/90 backdrop-blur-md rounded-full flex items-center justify-center text-white transform group-hover:scale-110 transition-transform duration-300 shadow-[0_0_30px_rgba(157,0,255,0.5)]">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <span class="mt-4 font-mono text-white tracking-widest text-xs uppercase font-bold drop-shadow-md">Play Reel 02</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4. PRODUCTION PIPELINE SECTION -->
<section class="py-24 md:py-32 bg-[#05050a] relative z-20 overflow-hidden">
    <div class="absolute left-0 top-1/2 w-[30rem] h-[30rem] bg-[#f9005b]/5 rounded-full blur-[120px] pointer-events-none -translate-y-1/2"></div>

    <div class="max-w-6xl mx-auto px-6 sm:px-8 relative z-10">
        <div class="text-center mb-24">
            <h2 class="text-4xl md:text-6xl font-space font-bold text-white uppercase tracking-tighter mb-4">
                Our Working <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Process</span>
            </h2>
            <p class="text-gray-400 font-light max-w-2xl mx-auto text-sm md:text-base">Sebagai agensi profesional, kami memiliki alur kerja yang transparan dan terstruktur untuk memastikan setiap proyek selesai tepat waktu, sesuai anggaran, dan melampaui ekspektasi Anda.</p>
        </div>

        <div class="relative">
            <!-- Garis Vertikal Tengah -->
            <div class="pipeline-line"></div>

            <!-- Langkah 1 -->
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-16 md:mb-24 group gs-reveal">
                <div class="md:w-1/2 text-left md:text-right pr-0 md:pr-16 mb-6 md:mb-0 pl-16 md:pl-0">
                    <h3 class="text-2xl md:text-3xl font-space font-bold text-white mb-2 uppercase">01. Ideation & Storyboarding</h3>
                    <p class="text-gray-400 font-light text-sm md:text-base leading-relaxed">Kami memulai dengan mendengarkan tujuan bisnis Anda. Tim kreatif kami akan merumuskan konsep, naskah, dan storyboard visual agar pesan brand Anda tersampaikan dengan sempurna.</p>
                </div>
                <div class="absolute left-8 md:left-1/2 w-6 h-6 rounded-full bg-[#05050a] border-2 border-white transform -translate-x-1/2 flex items-center justify-center z-10 group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-colors shadow-[0_0_15px_rgba(249,0,91,0)] group-hover:shadow-[0_0_20px_rgba(249,0,91,0.5)]"></div>
                <div class="md:w-1/2 pl-16 md:pl-16 hidden md:block">
                    <!-- Abstract Tech UI Graphic -->
                    <div class="w-full h-32 border border-white/20 rounded-2xl bg-white/[0.05] flex items-center justify-center gap-4">
                        <div class="w-12 h-16 border border-dashed border-gray-500 rounded"></div>
                        <div class="w-12 h-16 border border-solid border-[#f9005b]/70 bg-[#f9005b]/20 rounded shadow-[0_0_10px_rgba(249,0,91,0.3)]"></div>
                        <div class="w-12 h-16 border border-dashed border-gray-500 rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Langkah 2 -->
            <div class="relative flex flex-col md:flex-row-reverse items-start md:items-center justify-between mb-16 md:mb-24 group gs-reveal">
                <div class="md:w-1/2 text-left pl-16 md:pl-16 mb-6 md:mb-0">
                    <h3 class="text-2xl md:text-3xl font-space font-bold text-white mb-2 uppercase">02. 3D Design & Modeling</h3>
                    <p class="text-gray-400 font-light text-sm md:text-base leading-relaxed">Seniman kami mulai membentuk aset visual dari nol. Kami memastikan setiap objek, produk, atau karakter memiliki tekstur, warna, dan pencahayaan yang merepresentasikan kualitas premium brand Anda.</p>
                </div>
                <div class="absolute left-8 md:left-1/2 w-6 h-6 rounded-full bg-[#05050a] border-2 border-white transform -translate-x-1/2 flex items-center justify-center z-10 group-hover:bg-[#9d00ff] group-hover:border-[#9d00ff] transition-colors shadow-[0_0_15px_rgba(157,0,255,0)] group-hover:shadow-[0_0_20px_rgba(157,0,255,0.5)]"></div>
                <div class="md:w-1/2 pr-0 md:pr-16 pl-16 md:pl-0 hidden md:block">
                    <div class="w-full h-32 border border-white/20 rounded-2xl bg-white/[0.05] flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.2)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.2)_1px,transparent_1px)] bg-[size:10px_10px]"></div>
                        <div class="w-16 h-16 border border-[#9d00ff] transform rotate-45 bg-[#9d00ff]/20 backdrop-blur-sm z-10 shadow-[0_0_15px_rgba(157,0,255,0.4)]"></div>
                    </div>
                </div>
            </div>

            <!-- Langkah 3 -->
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-16 md:mb-24 group gs-reveal">
                <div class="md:w-1/2 text-left md:text-right pr-0 md:pr-16 mb-6 md:mb-0 pl-16 md:pl-0">
                    <h3 class="text-2xl md:text-3xl font-space font-bold text-white mb-2 uppercase">03. Animation & Movement</h3>
                    <p class="text-gray-400 font-light text-sm md:text-base leading-relaxed">Di tahap ini, desain statis diberikan 'nyawa'. Animator kami meracik pergerakan kamera dan objek agar terlihat sinematik, dinamis, dan memikat perhatian penonton sejak detik pertama.</p>
                </div>
                <div class="absolute left-8 md:left-1/2 w-6 h-6 rounded-full bg-[#05050a] border-2 border-white transform -translate-x-1/2 flex items-center justify-center z-10 group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-colors shadow-[0_0_15px_rgba(249,0,91,0)] group-hover:shadow-[0_0_20px_rgba(249,0,91,0.5)]"></div>
                <div class="md:w-1/2 pl-16 md:pl-16 hidden md:block">
                    <div class="w-full h-32 border border-white/20 rounded-2xl bg-white/[0.05] flex flex-col justify-center gap-4 p-6 relative overflow-hidden">
                        <div class="w-full h-1 bg-white/20 rounded-full relative">
                            <div class="absolute top-1/2 -translate-y-1/2 w-3 h-3 bg-[#f9005b] rounded-full left-[30%] shadow-[0_0_10px_#f9005b]"></div>
                        </div>
                        <div class="w-full h-1 bg-white/20 rounded-full relative">
                            <div class="absolute top-1/2 -translate-y-1/2 w-3 h-3 bg-white rounded-full left-[60%]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Langkah 4 -->
            <div class="relative flex flex-col md:flex-row-reverse items-start md:items-center justify-between group gs-reveal">
                <div class="md:w-1/2 text-left pl-16 md:pl-16 mb-6 md:mb-0">
                    <h3 class="text-2xl md:text-3xl font-space font-bold text-white mb-2 uppercase">04. Rendering & Post-Production</h3>
                    <p class="text-gray-400 font-light text-sm md:text-base leading-relaxed">Sentuhan akhir yang membuat karya menjadi mahakarya. Kami menggabungkan efek visual, desain suara (sound design), dan pewarnaan (color grading) untuk memberikan hasil akhir yang siap tayang dan memukau klien Anda.</p>
                </div>
                <div class="absolute left-8 md:left-1/2 w-6 h-6 rounded-full bg-[#05050a] border-2 border-white transform -translate-x-1/2 flex items-center justify-center z-10 group-hover:bg-[#9d00ff] group-hover:border-[#9d00ff] transition-colors shadow-[0_0_15px_rgba(157,0,255,0)] group-hover:shadow-[0_0_20px_rgba(157,0,255,0.5)]"></div>
                <div class="md:w-1/2 pr-0 md:pr-16 pl-16 md:pl-0 hidden md:block">
                    <div class="w-full h-32 border border-[#9d00ff]/50 rounded-2xl bg-[#9d00ff]/10 flex items-center justify-center shadow-[inset_0_0_30px_rgba(157,0,255,0.2)] relative overflow-hidden">
                        <div class="w-12 h-12 border-2 border-dashed border-[#9d00ff] rounded-full animate-[spin_4s_linear_infinite]"></div>
                        <div class="absolute inset-0 bg-gradient-to-tr from-[#f9005b]/20 to-transparent"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 5. VISUAL ARTIFACTS GALLERY (IMG2, IMG3, IMG4, IMG5) -->
<section class="py-24 md:py-32 bg-[#080815] relative z-20 border-t border-white/5">
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16 border-b border-white/10 pb-8">
            <div>
                <h2 class="text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Portfolio Gallery</h2>
                <p class="text-gray-400 font-sans mt-2">Jelajahi koleksi visual statis hasil render tingkat tinggi yang telah kami kerjakan.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card Gallery 1 -->
            <div class="rounded-[2rem] overflow-hidden bg-white/5 border border-white/15 group h-[300px] lg:h-[400px] relative gs-reveal cursor-pointer load-media-btn" data-url="{{ asset('assets/images/img2.jpg') }}" data-type="image" data-title="Abstract Geometry Render">
                <img src="{{ asset('assets/images/img2.jpg') }}" alt="Artwork 1" class="absolute inset-0 w-full h-full object-cover showcase-img">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/80 via-transparent to-transparent opacity-100"></div> <!-- Overlay diperterang -->
                <div class="absolute bottom-6 left-6 right-6 z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <span class="text-[10px] font-mono text-[#f9005b] tracking-widest bg-black/60 px-2 py-1 rounded">01 // PRODUCT VISUALIZATION</span>
                    <h3 class="text-white font-bold font-space mt-2 opacity-0 group-hover:opacity-100 transition-opacity">Abstract Geometry</h3>
                </div>
                <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full border border-white/40 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Card Gallery 2 -->
            <div class="rounded-[2rem] overflow-hidden bg-white/5 border border-white/15 group h-[300px] lg:h-[400px] relative gs-reveal cursor-pointer load-media-btn" data-url="{{ asset('assets/images/img3.jpg') }}" data-type="image" data-title="Sci-Fi Environment Concept">
                <img src="{{ asset('assets/images/img3.jpg') }}" alt="Artwork 2" class="absolute inset-0 w-full h-full object-cover showcase-img">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/80 via-transparent to-transparent opacity-100"></div> <!-- Overlay diperterang -->
                <div class="absolute bottom-6 left-6 right-6 z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <span class="text-[10px] font-mono text-[#9d00ff] tracking-widest bg-black/60 px-2 py-1 rounded">02 // ENVIRONMENT CONCEPT</span>
                    <h3 class="text-white font-bold font-space mt-2 opacity-0 group-hover:opacity-100 transition-opacity">Sci-Fi Environment</h3>
                </div>
                <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full border border-white/40 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Card Gallery 3 -->
            <div class="rounded-[2rem] overflow-hidden bg-white/5 border border-white/15 group h-[300px] lg:h-[400px] relative lg:translate-y-8 gs-reveal cursor-pointer load-media-btn" data-url="{{ asset('assets/images/img4.jpg') }}" data-type="image" data-title="Volumetric Lighting Study">
                <img src="{{ asset('assets/images/img4.jpg') }}" alt="Artwork 3" class="absolute inset-0 w-full h-full object-cover showcase-img">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/80 via-transparent to-transparent opacity-100"></div> <!-- Overlay diperterang -->
                <div class="absolute bottom-6 left-6 right-6 z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <span class="text-[10px] font-mono text-white/90 tracking-widest bg-black/60 px-2 py-1 rounded">03 // ATMOSPHERE & LIGHTING</span>
                    <h3 class="text-white font-bold font-space mt-2 opacity-0 group-hover:opacity-100 transition-opacity">Volumetric Lighting</h3>
                </div>
                <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full border border-white/40 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Card Gallery 4 -->
            <div class="rounded-[2rem] overflow-hidden bg-white/5 border border-white/15 group h-[300px] lg:h-[400px] relative lg:translate-y-8 gs-reveal cursor-pointer load-media-btn" data-url="{{ asset('assets/images/img5.jpg') }}" data-type="image" data-title="Cyberpunk Assets">
                <img src="{{ asset('assets/images/img5.jpg') }}" alt="Artwork 4" class="absolute inset-0 w-full h-full object-cover showcase-img">
                <div class="absolute inset-0 bg-gradient-to-t from-[#05050a]/80 via-transparent to-transparent opacity-100"></div> <!-- Overlay diperterang -->
                <div class="absolute bottom-6 left-6 right-6 z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <span class="text-[10px] font-mono text-[#f9005b] tracking-widest bg-black/60 px-2 py-1 rounded">04 // GAME ASSETS</span>
                    <h3 class="text-white font-bold font-space mt-2 opacity-0 group-hover:opacity-100 transition-opacity">Cyberpunk Assets</h3>
                </div>
                <div class="absolute inset-0 flex items-center justify-center z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full border border-white/40 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 6. CALL TO ACTION (Tanpa Testimoni, Bersih & Profesional) -->
<section class="py-32 bg-[#05050a] border-t border-white/10 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#f9005b]/10 via-[#05050a] to-[#05050a]"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-4xl md:text-6xl lg:text-7xl font-black text-white uppercase tracking-tighter mb-8 font-space">
            Got an Animation <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Project?</span>
        </h2>
        <p class="text-gray-400 font-light max-w-2xl mx-auto mb-10">
            Jangan biarkan ide hebat Anda hanya sebatas sketsa kasar. Mari berkolaborasi dengan tim animator profesional kami untuk menciptakan kampanye visual yang membuat kompetitor Anda tertinggal.
        </p>
        <a href="{{ url('/contact') }}" class="group relative inline-flex items-center justify-center bg-white text-black font-bold text-sm uppercase tracking-widest px-10 py-5 overflow-hidden rounded-full transition-all hover:scale-105 shadow-[0_0_40px_rgba(255,255,255,0.2)]">
            <span class="relative z-10 flex items-center gap-3">
                Start Free Consultation
                <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </span>
        </a>
    </div>
</section>

<!-- Memuat GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<!-- SCRIPT UNTUK ANIMASI HALAMAN & CANGGIH MODAL PLAYER -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. SETUP GSAP SCROLL ANIMATIONS ---
        gsap.registerPlugin(ScrollTrigger);

        // Animasi Kinetic Text Marquee
        if(document.querySelector("#kinetic-animation")) {
            gsap.to(".marquee-left", { xPercent: -15, ease: "none", scrollTrigger: { trigger: "#kinetic-animation", start: "top bottom", end: "bottom top", scrub: 1 }});
            gsap.to(".marquee-right", { xPercent: 15, ease: "none", scrollTrigger: { trigger: "#kinetic-animation", start: "top bottom", end: "bottom top", scrub: 1 }});
            gsap.to("#kinetic-animation .kinetic-word", {
                color: "#9d00ff", webkitTextStrokeColor: "transparent", textShadow: "0 0 40px rgba(157,0,255,0.5)", stagger: 0.05,
                scrollTrigger: { trigger: "#kinetic-animation", start: "top 60%", end: "center center", scrub: 1 }
            });
        }

        // Animasi Elemen Fade-Up saat di scroll
        const revealElements = document.querySelectorAll(".gs-reveal");
        revealElements.forEach((elem) => {
            gsap.fromTo(elem, 
                { autoAlpha: 0, y: 50 }, 
                { duration: 1, autoAlpha: 1, y: 0, ease: "power3.out", scrollTrigger: { trigger: elem, start: "top 85%" } }
            );
        });


        // --- 2. SETUP DYNAMIC MEDIA MODAL (VIDEO & IMAGE PLAYER) ---
        const previewModal = document.createElement('div');
        previewModal.className = 'fixed inset-0 z-[99999] bg-[#05050a]/95 backdrop-blur-md flex flex-col opacity-0 pointer-events-none transition-opacity duration-500';
        previewModal.innerHTML = `
            <div class="flex items-center justify-between px-4 md:px-6 py-3 md:py-4 bg-transparent border-b border-white/5 shadow-lg relative z-20">
                <div class="flex items-center gap-2 md:gap-3 overflow-hidden pr-2">
                    <span class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-[#f9005b] animate-pulse shrink-0"></span>
                    <span class="text-white font-mono text-[10px] md:text-sm tracking-widest uppercase truncate" id="modal-title">Media Viewer</span>
                </div>
                <button id="close-modal-btn" class="flex items-center shrink-0 gap-1.5 md:gap-2 bg-white/10 text-white px-4 md:px-6 py-1.5 md:py-2.5 rounded-full font-bold text-xs md:text-base cursor-pointer hover:bg-[#f9005b] transition-all">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="hidden sm:inline">Close</span>
                </button>
            </div>
            <div class="relative flex-1 w-full h-full flex items-center justify-center p-4 md:p-12">
                <!-- Loading Spinner -->
                <div id="modal-loader" class="absolute inset-0 flex flex-col items-center justify-center z-10 transition-opacity duration-300">
                    <div class="w-12 h-12 border-4 border-white/10 border-t-[#9d00ff] rounded-full animate-spin mb-4"></div>
                    <p class="text-gray-400 font-mono text-sm tracking-widest animate-pulse">Memuat Aset...</p>
                </div>
                <!-- Container Konten Dinamis (Video/Image) -->
                <div id="modal-content-container" class="w-full h-full relative z-20 flex items-center justify-center"></div>
            </div>
        `;
        document.body.appendChild(previewModal);

        const modalTitle = previewModal.querySelector('#modal-title');
        const modalLoader = previewModal.querySelector('#modal-loader');
        const modalContent = previewModal.querySelector('#modal-content-container');
        const closeModalBtn = previewModal.querySelector('#close-modal-btn');

        // Trigger Buka Modal Media
        const loadMediaButtons = document.querySelectorAll('.load-media-btn');
        loadMediaButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('data-url');
                const type = this.getAttribute('data-type');
                const title = this.getAttribute('data-title');
                openMediaModal(url, title, type);
            });
        });

        function openMediaModal(url, title, type) {
            modalTitle.innerText = title;
            modalLoader.style.opacity = '1';
            modalContent.innerHTML = ''; // Kosongkan kontainer
            previewModal.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; 

            if (type === 'video') {
                // Render Video
                const videoEl = document.createElement('video');
                videoEl.src = url;
                videoEl.controls = true;
                videoEl.autoplay = true;
                videoEl.className = 'max-w-full max-h-full object-contain rounded-xl shadow-2xl';
                modalContent.appendChild(videoEl);
                
                // Hilangkan loader begitu video bisa dimainkan
                videoEl.oncanplay = () => {
                    modalLoader.style.opacity = '0';
                };
            } else if (type === 'image') {
                // Render Gambar HD
                const imgEl = document.createElement('img');
                imgEl.src = url;
                imgEl.className = 'max-w-full max-h-full object-contain rounded-xl shadow-2xl';
                modalContent.appendChild(imgEl);

                // Hilangkan loader begitu gambar selesai di-load
                imgEl.onload = () => {
                    modalLoader.style.opacity = '0';
                };
            }
        }

        // Trigger Tutup Modal Media
        closeModalBtn.addEventListener('click', () => {
            previewModal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = ''; 
            modalContent.innerHTML = ''; // Bersihkan elemen agar video/audio berhenti
            modalTitle.innerText = 'Media Viewer';
        });
    });
</script>
@endsection