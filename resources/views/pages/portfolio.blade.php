@extends('layouts.main')

@section('title', 'Portfolio - Lund\'or Imagine Digital')

@section('content')
<!-- Memuat font khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<style>
    /* Typography & Utilities */
    .font-space { font-family: 'Space Grotesk', sans-serif; }
    
    /* Scrollbar Styling untuk iframe */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #05050a;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #f9005b;
        border-radius: 4px;
    }

    /* Animasi Loading Button */
    @keyframes pulse-fast {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .loading-pulse {
        animation: pulse-fast 1s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Bento Grid (Social Media) Hover Effects */
    .bento-item {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: zoom-in;
    }
    .bento-item img, .bento-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease, filter 0.5s ease;
        filter: brightness(0.95) contrast(1.05);
    }
    .bento-item:hover img, .bento-item:hover video {
        transform: scale(1.05);
        filter: brightness(1.1) contrast(1.1);
    }
    .bento-item::after {
        content: '';
        position: absolute;
        inset: 0;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 1.5rem;
        pointer-events: none;
        transition: border-color 0.3s ease;
    }
    .bento-item:hover::after {
        border-color: rgba(157, 0, 255, 0.5);
        box-shadow: inset 0 0 20px rgba(157, 0, 255, 0.2);
    }

    /* Glitch Title */
    .glitch-title {
        position: relative;
        color: white;
    }
    .glitch-title::before, .glitch-title::after {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.8;
    }
    .glitch-title::before {
        left: 2px;
        text-shadow: -2px 0 #f9005b;
        clip: rect(24px, 550px, 90px, 0);
        animation: glitch-anim 3s infinite linear alternate-reverse;
    }
    .glitch-title::after {
        left: -2px;
        text-shadow: -2px 0 #9d00ff;
        clip: rect(85px, 550px, 140px, 0);
        animation: glitch-anim 2s infinite linear alternate-reverse;
    }

    /* --- MARQUEE LOGOS STYLE --- */
    .marquee-wrapper {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }
    .marquee-wrapper::before, .marquee-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
    }
    .marquee-wrapper::before {
        left: 0;
        background: linear-gradient(to right, #080815 0%, transparent 100%);
    }
    .marquee-wrapper::after {
        right: 0;
        background: linear-gradient(to left, #080815 0%, transparent 100%);
    }
    .marquee-content {
        display: inline-flex;
        animation: scroll-marquee 40s linear infinite;
        width: max-content;
        align-items: center;
    }
    @keyframes scroll-marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .client-logo-item {
        filter: grayscale(100%) brightness(200%);
        opacity: 0.3;
        transition: all 0.4s ease;
        height: 45px;
        width: auto;
        object-fit: contain;
    }
    .client-logo-item:hover {
        filter: grayscale(0%) brightness(100%);
        opacity: 1;
        transform: scale(1.1);
    }
    .client-text-logo {
        color: white;
        font-weight: 900;
        font-size: 1.5rem;
        opacity: 0.3;
        transition: opacity 0.4s;
        letter-spacing: 0.1em;
    }
    .client-text-logo:hover {
        opacity: 1;
    }

    /* Lightbox Styling */
    #image-lightbox {
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    #image-lightbox.active {
        opacity: 1;
        pointer-events: auto;
    }
</style>

<!-- HERO SECTION -->
<section class="pt-32 pb-20 md:pt-48 md:pb-32 min-h-[60vh] bg-[#05050a] relative overflow-hidden z-30 flex items-center border-b border-white/5">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[50rem] h-[50rem] bg-[#f9005b]/10 rounded-full blur-[150px] pointer-events-none z-0 translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10 w-full">
        <p class="text-[#f9005b] font-mono text-sm tracking-widest uppercase mb-4 animate-pulse border border-[#f9005b]/30 bg-[#f9005b]/10 inline-block px-4 py-1.5 rounded-full">
            // STATUS: CLASSIFIED ARCHIVE
        </p>
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter mb-6 leading-none font-space glitch-title" data-text="SELECTED WORKS">
            SELECTED <br> WORKS
        </h1>
        <p class="text-gray-400 text-lg md:text-2xl font-sans max-w-3xl leading-relaxed font-light">
            Ini bukan sekadar galeri. Ini adalah bukti nyata bagaimana kami mendekonstruksi aturan, merancang ulang identitas, dan melahirkan karya digital yang menolak untuk dilupakan.
        </p>
    </div>
</section>

<!-- CASE STUDY 01: GEELY (WEB DEVELOPMENT) -->
<section class="py-24 md:py-32 bg-[#080815] relative overflow-hidden">
    <div class="absolute top-1/2 left-0 w-1/3 h-full bg-gradient-to-r from-[#0a0a14] to-transparent z-10 pointer-events-none"></div>
    
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-20">
        
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 mb-16">
            <div class="max-w-2xl">
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-gray-700 to-gray-900 font-space">01</span>
                    <div class="h-[1px] w-20 bg-gray-700"></div>
                    <span class="font-mono text-[#f9005b] text-sm uppercase tracking-widest">Web Development</span>
                </div>
                <img src="{{ asset('assets/images/logo-client/logo-geely.png') }}" alt="Geely Logo" class="h-12 md:h-16 w-auto object-contain mb-8 filter brightness-200">
                <h2 class="text-4xl md:text-6xl font-black text-white font-space uppercase tracking-tighter mb-4">The Geely <br><span class="text-[#f9005b]">Digital Fleet</span></h2>
                <p class="text-gray-400 font-light text-lg">
                    Pengembangan platform otomotif berkinerja tinggi. Kami membangun ekosistem digital Geely untuk regional Fatmawati dan BSD dengan fokus pada interaksi imersif, kecepatan *loading*, dan konversi *test-drive*.
                </p>
            </div>
            
            <div class="flex gap-4">
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Laravel</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">UI/UX</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">3D Assets</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="portfolio-card relative rounded-3xl overflow-hidden border border-white/10 bg-[#0a0a14] group shadow-2xl">
                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="px-4 py-1.5 text-xs font-bold font-mono bg-[#f9005b]/20 text-[#f9005b] backdrop-blur-md rounded-full border border-[#f9005b]/30">GEELY FATMAWATI</span>
                </div>
                <div class="relative w-full pt-[56.25%] bg-[#080815] overflow-hidden">
                    <img src="{{ asset('assets/images/2026-03-18 210733.png') }}" alt="Geely Fatmawati Cover" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 group-hover:opacity-40 transition-all duration-700 ease-in-out z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14]/60 via-transparent to-transparent z-0 pointer-events-none"></div>
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center transition-opacity duration-500">
                        <button class="load-iframe-btn flex items-center gap-3 bg-black/50 backdrop-blur-md border border-[#f9005b] text-[#f9005b] px-8 py-3.5 rounded-full font-bold hover:bg-[#f9005b] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(249,0,91,0.2)] hover:shadow-[0_0_30px_rgba(249,0,91,0.6)] cursor-pointer" data-url="https://geelyfatmawati.id">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Launch Experience
                        </button>
                    </div>
                </div>
            </div>

            <div class="portfolio-card relative rounded-3xl overflow-hidden border border-white/10 bg-[#0a0a14] group shadow-2xl md:translate-y-12">
                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="px-4 py-1.5 text-xs font-bold font-mono bg-[#9d00ff]/20 text-[#9d00ff] backdrop-blur-md rounded-full border border-[#9d00ff]/30">GEELY BSD</span>
                </div>
                <div class="relative w-full pt-[56.25%] bg-[#080815] overflow-hidden">
                    <img src="{{ asset('assets/images/2026-03-18 211448.png') }}" alt="Geely BSD Cover" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 group-hover:opacity-40 transition-all duration-700 ease-in-out z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14]/60 via-transparent to-transparent z-0 pointer-events-none"></div>
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center transition-opacity duration-500">
                        <button class="load-iframe-btn flex items-center gap-3 bg-black/50 backdrop-blur-md border border-[#9d00ff] text-[#9d00ff] px-8 py-3.5 rounded-full font-bold hover:bg-[#9d00ff] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(157,0,255,0.2)] hover:shadow-[0_0_30px_rgba(157,0,255,0.6)] cursor-pointer" data-url="https://geelybsd.id">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Launch Experience
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CASE STUDY 02: MAISON THE RAUX (SOCIAL MEDIA) -->
<section class="py-24 md:py-32 bg-[#05050a] relative border-t border-white/5">
    <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-[#9d00ff]/5 rounded-full blur-[150px] pointer-events-none z-0"></div>
    
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-10">
        
        <div class="flex flex-col lg:flex-row-reverse justify-between items-start lg:items-end gap-8 mb-16 text-left lg:text-right">
            <div class="max-w-2xl flex flex-col items-start lg:items-end">
                <div class="flex items-center gap-4 mb-6 flex-row-reverse lg:flex-row">
                    <span class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-gray-700 to-gray-900 font-space">02</span>
                    <div class="h-[1px] w-20 bg-gray-700"></div>
                    <span class="font-mono text-[#9d00ff] text-sm uppercase tracking-widest">Social Media</span>
                </div>
                <img src="{{ asset('assets/images/logo-client/images.png') }}" alt="Maison The Raux Logo" class="h-16 md:h-24 w-auto object-contain mb-6">
                <h2 class="text-4xl md:text-6xl font-black text-white font-space uppercase tracking-tighter mb-4">Maison <br><span class="text-[#9d00ff]">The Raux</span></h2>
                <p class="text-gray-400 font-light text-lg">
                    Memecah algoritma dengan estetika. Strategi media sosial, *art direction*, dan produksi visual *high-end* yang mendefinisikan ulang cara *brand* fashion berinteraksi dengan audiens digital. Klik gambar atau video untuk melihat resolusi penuh.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-4 mt-8 lg:mt-0">
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Art Direction</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Photography</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Videography</span>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 auto-rows-[150px] sm:auto-rows-[180px] md:auto-rows-[280px]">
            <div class="bento-item col-span-1 md:col-span-1 row-span-2 shadow-[0_10px_30px_rgba(0,0,0,0.8)] group relative">
                <video src="{{ asset('assets/video/c0026_1.MP4') }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none bg-black/20">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-black/50 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-lg">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-3 left-3 md:bottom-6 md:left-6 z-10 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                    <span class="px-2 md:px-3 py-1 bg-black/60 backdrop-blur-md text-white text-[8px] md:text-[10px] font-mono tracking-widest border border-white/20 rounded-full">Video</span>
                </div>
            </div>

            <div class="bento-item col-span-1 md:col-span-1 row-span-2 shadow-lg">
                <img src="{{ asset('assets/images/social-media/IMG_8191.JPG') }}" alt="Maison The Raux Portrait" loading="lazy">
            </div>

            <div class="bento-item col-span-2 md:col-span-2 row-span-1 shadow-xl">
                <img src="{{ asset('assets/images/social-media/AZS02836.jpg') }}" alt="Maison The Raux Campaign 1" loading="lazy" style="object-position: center 30%;">
            </div>

            <div class="bento-item col-span-1 md:col-span-1 row-span-1 shadow-lg">
                <img src="{{ asset('assets/images/social-media/AZS02960.jpg') }}" alt="Maison The Raux Detail 1" loading="lazy">
            </div>

            <div class="bento-item col-span-1 md:col-span-1 row-span-1 shadow-lg">
                <img src="{{ asset('assets/images/social-media/AZS03060.jpg') }}" alt="Maison The Raux Campaign 2" loading="lazy">
            </div>

            <div class="bento-item col-span-2 md:col-span-4 row-span-1 md:row-span-2 shadow-2xl group">
                <img src="{{ asset('assets/images/social-media/P1360705.png') }}" alt="Maison The Raux Wide Shot" loading="lazy" style="object-position: center 30%;">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] to-transparent opacity-40 pointer-events-none transition-opacity duration-300 group-hover:opacity-20"></div>
                <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 z-10 pointer-events-none">
                    <h3 class="text-lg md:text-3xl font-black text-white font-space uppercase tracking-widest">Brand <span class="text-[#9d00ff]">Evolution</span></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CASE STUDY 03: FIRST SOLUTION (MULTIMEDIA & EDUCATION) -->
<section class="py-24 md:py-32 bg-[#080815] relative border-t border-white/5 overflow-hidden">
    <!-- Dekorasi Background -->
    <div class="absolute bottom-0 left-0 w-[40rem] h-[40rem] bg-[#f9005b]/5 rounded-full blur-[150px] pointer-events-none z-0"></div>
    
    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-10">
        
        <!-- Header Case Study -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 mb-16">
            <div class="max-w-2xl">
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-gray-700 to-gray-900 font-space">03</span>
                    <div class="h-[1px] w-20 bg-gray-700"></div>
                    <span class="font-mono text-[#f9005b] text-sm uppercase tracking-widest">Multimedia Production</span>
                </div>
                <!-- Logo Klien -->
                <img src="{{ asset('assets/images/logo-client/logo-rev2.webp') }}" alt="First Solution Logo" class="h-14 md:h-20 w-auto object-contain mb-8 filter brightness-110">
                <h2 class="text-4xl md:text-6xl font-black text-white font-space uppercase tracking-tighter mb-4">First <br><span class="text-[#f9005b]">Solution</span></h2>
                <p class="text-gray-400 font-light text-lg">
                    Mendefinisikan standar keselamatan melalui konten visual berkualitas. Kami memproduksi video edukasi TKPK1 dan dokumentasi peluncuran kolaborasi strategis First Solution x Midiatama dengan pendekatan sinematik.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-4 mt-8 lg:mt-0">
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Motion Design</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Safety Education</span>
                <span class="px-4 py-2 border border-white/10 rounded-full text-xs font-mono text-gray-400 bg-white/5 backdrop-blur-md">Corporate Production</span>
            </div>
        </div>

        <!-- Bento Grid for Videos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 auto-rows-[250px] md:auto-rows-[350px]">
            
            <!-- 1. Video Edukasi TKPK1 (Local MP4) - Large Area -->
            <div class="bento-item col-span-1 md:col-span-2 row-span-2 shadow-2xl group relative overflow-hidden rounded-[2rem]">
                <video src="{{ asset('assets/video/fs-edu.mp4') }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                
                <div class="absolute bottom-8 left-8 z-10">
                    <span class="px-3 py-1 bg-[#f9005b] text-white text-[10px] font-mono tracking-widest rounded-full mb-3 inline-block shadow-lg">TKPK1 EDUCATION</span>
                    <h3 class="text-2xl md:text-4xl font-black text-white font-space uppercase">Standard <span class="text-[#f9005b]">Safety</span> Training</h3>
                </div>

                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/40">
                    <div class="w-20 h-20 rounded-full bg-[#f9005b] flex items-center justify-center shadow-[0_0_40px_rgba(249,0,91,0.5)]">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>

            <!-- 2. YouTube Video 1 (First Solution Content) -->
            <div class="bento-item col-span-1 row-span-1 shadow-xl group relative overflow-hidden rounded-[2rem]">
                <!-- Thumbnail Cover to hide YT Logo -->
                <img src="https://img.youtube.com/vi/MrwVPoIJtGQ/maxresdefault.jpg" alt="First Solution Content" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <button class="load-yt-btn w-16 h-16 rounded-full bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white hover:bg-[#f9005b] hover:border-[#f9005b] transition-all" data-yt-id="MrwVPoIJtGQ">
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
                <div class="absolute bottom-6 left-6 z-10">
                    <p class="text-white font-bold font-space text-sm tracking-widest uppercase opacity-70">Visual Solutions</p>
                </div>
            </div>

            <!-- 3. YouTube Video 2 (Collaboration Launch) -->
            <div class="bento-item col-span-1 row-span-1 shadow-xl group relative overflow-hidden rounded-[2rem]">
                <!-- Thumbnail Cover to hide YT Logo -->
                <img src="https://img.youtube.com/vi/SiaOzpsGO18/maxresdefault.jpg" alt="Collaboration First Solution x Midiatama" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-colors"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <button class="load-yt-btn w-16 h-16 rounded-full bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white hover:bg-[#f9005b] hover:border-[#f9005b] transition-all" data-yt-id="SiaOzpsGO18">
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
                <div class="absolute bottom-6 left-6 z-10">
                    <p class="text-white font-bold font-space text-sm tracking-widest uppercase opacity-70">Launch Event</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION LOGO CLIENT BERJALAN -->
<section id="trusted-clients" class="py-20 bg-[#080815] relative z-30 border-t border-white/5 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 text-center mb-12">
        <h4 class="text-gray-500 font-mono text-xs uppercase tracking-[0.4em] mb-4">World-Class Partnerships</h4>
        <div class="h-[1px] w-24 bg-gradient-to-r from-transparent via-[#f9005b] to-transparent mx-auto"></div>
    </div>

    <!-- Area Marquee Infinite Scroll -->
    <div class="marquee-wrapper w-full py-4">
        <div class="marquee-content gap-20 md:gap-32 px-20">
            <!-- Set 1 -->
            <img src="{{ asset('assets/images/logo-client/logo-rev2.webp') }}" class="client-logo-item" alt="First Solution">
            <img src="{{ asset('assets/images/logo-client/logo-geely.png') }}" class="client-logo-item" alt="Geely">
            <img src="{{ asset('assets/images/logo-client/images.png') }}" class="client-logo-item" alt="Maison The Raux">
            <span class="client-text-logo font-space uppercase">NEXUS</span>
            <span class="client-text-logo font-space uppercase">AETHER</span>
            <span class="client-text-logo font-space uppercase">LUMINA</span>
            <span class="client-text-logo font-space uppercase">OBELISK</span>
            
            <!-- Set 2 (Duplicate for Seamless Loop) -->
            <img src="{{ asset('assets/images/logo-client/logo-rev2.webp') }}" class="client-logo-item" alt="First Solution">
            <img src="{{ asset('assets/images/logo-client/logo-geely.png') }}" class="client-logo-item" alt="Geely">
            <img src="{{ asset('assets/images/logo-client/images.png') }}" class="client-logo-item" alt="Maison The Raux">
            <span class="client-text-logo font-space uppercase">NEXUS</span>
            <span class="client-text-logo font-space uppercase">AETHER</span>
            <span class="client-text-logo font-space uppercase">LUMINA</span>
            <span class="client-text-logo font-space uppercase">OBELISK</span>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-32 bg-[#080815] border-t border-white/10 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#f9005b]/10 via-[#0a0a14] to-[#0a0a14]"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-8 font-space">
            Karya Selanjutnya <br>Adalah <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Milik Anda.</span>
        </h2>
        <a href="{{ url('/contact') }}" class="group relative inline-flex items-center justify-center bg-white text-black font-black text-xl px-10 py-5 overflow-hidden rounded-full transition-all hover:scale-105 shadow-[0_0_40px_rgba(255,255,255,0.2)]">
            <span class="relative z-10 flex items-center gap-3">
                Mari Berdiskusi
                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </span>
        </a>
    </div>
</section>

<!-- LIGHTBOX MODAL UNTUK FULL IMAGE & VIDEO -->
<div id="image-lightbox" class="fixed inset-0 z-[100] bg-[#05050a]/95 backdrop-blur-sm flex items-center justify-center p-4 lg:p-10">
    <button id="close-lightbox" class="absolute top-4 right-4 md:top-6 md:right-6 lg:top-10 lg:right-10 text-white bg-white/10 p-2 md:p-3 rounded-full hover:bg-[#f9005b] transition-colors shadow-lg z-50">
        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <img id="lightbox-img" src="" alt="Full Screen" class="hidden max-w-full max-h-[90vh] object-contain rounded-xl shadow-[0_0_50px_rgba(0,0,0,0.8)] transition-transform duration-300 transform scale-95">
    <video id="lightbox-video" src="" controls class="hidden max-w-full max-h-[90vh] object-contain rounded-xl shadow-[0_0_50px_rgba(0,0,0,0.8)] transition-transform duration-300 transform scale-95"></video>
</div>

<!-- SCRIPT UNTUK LIVE PREVIEW IFRAME & LIGHTBOX -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. LOGIC UNTUK LIVE PREVIEW IFRAME (WEBSITE & YOUTUBE) - GLOBAL MODAL FIX ---
        const cursorDot = document.getElementById('cursor-dot');
        const cursorOutline = document.getElementById('cursor-outline');
        
        // Buat elemen Fullscreen Modal satu kali di dalam Body
        const previewModal = document.createElement('div');
        previewModal.className = 'fixed inset-0 z-[99999] bg-[#05050a] flex flex-col opacity-0 pointer-events-none transition-opacity duration-500';
        previewModal.innerHTML = `
            <div class="flex items-center justify-between px-4 md:px-6 py-3 md:py-4 bg-[#0a0a14] border-b border-white/10 shadow-lg relative z-20">
                <div class="flex items-center gap-2 md:gap-3 overflow-hidden pr-2">
                    <span class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-[#f9005b] animate-pulse shrink-0"></span>
                    <span class="text-white font-mono text-[10px] md:text-sm tracking-widest uppercase truncate" id="modal-title">Live Preview</span>
                </div>
                <button id="close-modal-btn" class="flex items-center shrink-0 gap-1.5 md:gap-2 bg-[#f9005b] text-white px-4 md:px-6 py-1.5 md:py-2.5 rounded-full font-bold text-xs md:text-base cursor-pointer hover:bg-white hover:text-black transition-all shadow-[0_0_20px_rgba(249,0,91,0.4)]">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="hidden sm:inline">Tutup Preview</span>
                    <span class="sm:hidden">Tutup</span>
                </button>
            </div>
            <div class="relative flex-1 w-full h-full bg-[#000]">
                <!-- Loading Spinner -->
                <div id="modal-loader" class="absolute inset-0 flex flex-col items-center justify-center bg-[#080815] z-10 transition-opacity duration-300">
                    <div class="w-12 h-12 border-4 border-white/10 border-t-[#f9005b] rounded-full animate-spin mb-4"></div>
                    <p class="text-gray-400 font-mono text-sm tracking-widest animate-pulse">Menghubungkan...</p>
                </div>
                <!-- Iframe Sebenarnya -->
                <iframe id="modal-iframe" src="about:blank" class="w-full h-full border-none relative z-0 custom-scrollbar" allow="autoplay; fullscreen"></iframe>
            </div>
        `;
        document.body.appendChild(previewModal);

        const modalTitle = previewModal.querySelector('#modal-title');
        const modalLoader = previewModal.querySelector('#modal-loader');
        const modalIframe = previewModal.querySelector('#modal-iframe');
        const closeModalBtn = previewModal.querySelector('#close-modal-btn');

        // Logika ketika tombol "Live Preview" Website ditekan
        const loadWebButtons = document.querySelectorAll('.load-iframe-btn');
        loadWebButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('data-url');
                openPreviewModal(url, url);
            });
        });

        // Logika ketika tombol "YouTube" ditekan (Hapus Logo YT via Embed Params)
        const loadYTButtons = document.querySelectorAll('.load-yt-btn');
        loadYTButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const ytId = this.getAttribute('data-yt-id');
                // Modestbranding=1 & rel=0 untuk meminimalisir logo & video terkait
                const ytUrl = `https://www.youtube.com/embed/${ytId}?autoplay=1&modestbranding=1&rel=0&iv_load_policy=3&showinfo=0`;
                openPreviewModal(ytUrl, "Video Production // First Solution");
            });
        });

        function openPreviewModal(url, title) {
            modalTitle.innerText = title;
            modalLoader.style.opacity = '1';
            modalLoader.style.pointerEvents = 'auto';
            previewModal.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; 
            modalIframe.src = url;

            modalIframe.onload = () => {
                if (modalIframe.src !== 'about:blank') {
                    modalLoader.style.opacity = '0';
                    setTimeout(() => modalLoader.style.pointerEvents = 'none', 300);
                }
            };
        }

        // Logika Tutup Preview
        closeModalBtn.addEventListener('click', () => {
            previewModal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = ''; 
            modalIframe.src = 'about:blank';
            modalTitle.innerText = 'Live Preview';
        });

        // --- 2. LOGIC UNTUK FULL IMAGE & VIDEO LIGHTBOX (SOCIAL MEDIA BENTO) ---
        const lightbox = document.getElementById('image-lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxVideo = document.getElementById('lightbox-video');
        const closeLightboxBtn = document.getElementById('close-lightbox');
        const bentoItems = document.querySelectorAll('.bento-item');

        bentoItems.forEach(item => {
            // Jangan jalankan lightbox jika item mengandung tombol youtube (sudah dihandle modal preview)
            if (item.querySelector('.load-yt-btn')) return;

            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                const video = this.querySelector('video');

                if (img) {
                    lightboxImg.src = img.src;
                    lightboxImg.classList.remove('hidden');
                    lightboxVideo.classList.add('hidden');
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden'; 
                    setTimeout(() => { lightboxImg.classList.replace('scale-95', 'scale-100'); }, 50);
                } else if (video) {
                    lightboxVideo.src = video.src;
                    lightboxVideo.classList.remove('hidden');
                    lightboxImg.classList.add('hidden');
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    setTimeout(() => {
                        lightboxVideo.classList.replace('scale-95', 'scale-100');
                        lightboxVideo.play();
                    }, 50);
                }
            });
        });

        const closeLightbox = () => {
            lightboxImg.classList.replace('scale-100', 'scale-95');
            lightboxVideo.classList.replace('scale-100', 'scale-95');
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; 
            setTimeout(() => { 
                lightboxImg.src = ''; 
                lightboxVideo.pause();
                lightboxVideo.src = '';
            }, 300);
        };

        closeLightboxBtn.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function(e) { if (e.target === lightbox) closeLightbox(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && lightbox.classList.contains('active')) closeLightbox(); });
    });
</script>
@endsection