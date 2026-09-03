@extends('layouts.main')

@section('title', 'Home - Lund\'or Imagine Digital')

@section('content')
<!-- Mengambil font khusus dari desain Anda -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<!-- CSS Khusus -->
<style>
    /* Compatibility Fixes untuk Safari WebKit Engine */
    .bg-clip-text {
        -webkit-background-clip: text !important;
        background-clip: text !important;
    }
    .text-transparent {
        -webkit-text-fill-color: transparent !important;
    }
    
    /* Cross-browser Backdrop Blur untuk Safari */
    .backdrop-blur-md {
        -webkit-backdrop-filter: blur(12px);
        backdrop-filter: blur(12px);
    }
    .backdrop-blur-xl {
        -webkit-backdrop-filter: blur(24px);
        backdrop-filter: blur(24px);
    }
    .backdrop-blur-2xl {
        -webkit-backdrop-filter: blur(40px);
        backdrop-filter: blur(40px);
    }
    .backdrop-blur-sm {
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px);
    }

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

    /* Untuk Canvas Portaplane agar presisi */
    #portaplane-canvas-wrapper canvas,
    #city-canvas-wrapper canvas {
        display: block;
        width: 100% !important;
        height: 100% !important;
        outline: none;
    }

    /* Efek Outline untuk Kinetic Typography */
    .text-outline {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.15);
        transition: color 0.3s ease, -webkit-text-stroke-color 0.3s ease;
    }
    @media (min-width: 768px) {
        .text-outline {
            -webkit-text-stroke: 2px rgba(255, 255, 255, 0.15);
        }
    }

    /* Optimasi Animasi GPU Safari & Modern Browser */
    .will-change-transform {
        will-change: transform;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    /* 1. Glitch Effect CSS Safari Safe */
    .glitch-wrapper {
        position: relative;
    }
    .glitch-text {
        position: relative;
        color: white;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        z-index: 1;
    }
    .glitch-text::before,
    .glitch-text::after {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        will-change: clip, transform;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .glitch-text::before {
        left: 3px;
        text-shadow: -2px 0 #f9005b;
        clip: rect(24px, 550px, 90px, 0);
        -webkit-clip-path: inset(24px 0 60px 0);
        clip-path: inset(24px 0 60px 0);
        animation: glitch-anim 3s infinite linear alternate-reverse;
        z-index: -1;
    }
    .glitch-text::after {
        left: -3px;
        text-shadow: -2px 0 #0ff;
        clip: rect(85px, 550px, 140px, 0);
        -webkit-clip-path: inset(85px 0 10px 0);
        clip-path: inset(85px 0 10px 0);
        animation: glitch-anim 2s infinite linear alternate-reverse;
        z-index: -2;
    }
    @keyframes glitch-anim {
        0% { clip: rect(10px, 9999px, 83px, 0); -webkit-clip-path: inset(10px 0 60px 0); clip-path: inset(10px 0 60px 0); }
        20% { clip: rect(61px, 9999px, 34px, 0); -webkit-clip-path: inset(61px 0 20px 0); clip-path: inset(61px 0 20px 0); }
        40% { clip: rect(23px, 9999px, 98px, 0); -webkit-clip-path: inset(23px 0 40px 0); clip-path: inset(23px 0 40px 0); }
        60% { clip: rect(88px, 9999px, 12px, 0); -webkit-clip-path: inset(88px 0 5px 0); clip-path: inset(88px 0 5px 0); }
        80% { clip: rect(4px, 9999px, 76px, 0); -webkit-clip-path: inset(4px 0 30px 0); clip-path: inset(4px 0 30px 0); }
        100% { clip: rect(50px, 9999px, 30px, 0); -webkit-clip-path: inset(50px 0 50px 0); clip-path: inset(50px 0 50px 0); }
    }

    /* 2. Vibe Configurator Advanced Slider Styling */
    .advanced-slider {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 6px;
        background: transparent;
        outline: none;
        position: relative;
    }
    .advanced-slider::-webkit-slider-runnable-track {
        width: 100%;
        height: 6px;
        background: rgba(128, 128, 128, 0.25);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.3);
    }
    .advanced-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        height: 36px;
        width: 24px;
        border-radius: 4px;
        background: #0a0a14;
        cursor: grab;
        margin-top: -16px;
        box-shadow: 0 0 25px rgba(249, 0, 91, 0.8), inset 0 0 10px rgba(249,0,91,0.5);
        border: 2px solid #f9005b;
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.2s, border-color 0.2s;
        position: relative;
        background-image: -webkit-repeating-linear-gradient(left, transparent, transparent 2px, rgba(255,255,255,0.3) 2px, rgba(255,255,255,0.3) 4px);
        background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(255,255,255,0.3) 2px, rgba(255,255,255,0.3) 4px);
        background-position: center;
        background-size: 10px 10px;
        background-repeat: no-repeat;
    }
    .advanced-slider:active::-webkit-slider-thumb {
        cursor: grabbing;
        transform: scale(1.1);
        -webkit-transform: scale(1.1);
    }
    .advanced-slider:hover::-webkit-slider-thumb {
        box-shadow: 0 0 35px rgba(157, 0, 255, 0.9), inset 0 0 15px rgba(157,0,255,0.8);
        border-color: #9d00ff;
    }

    /* 3. Slider Mekanisme Modern GSAP Safari Optimized */
    .slider-viewport {
        overflow: hidden;
        width: 100%;
        padding: 20px 0;
        -webkit-overflow-scrolling: touch;
    }
    .slider-track {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        gap: 24px;
        will-change: transform;
        transition: none; /* Dikelola oleh GSAP */
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .btn-nav-slider {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.05);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .btn-nav-slider:hover:not(:disabled) {
        background: #f9005b;
        border-color: #f9005b;
        transform: scale(1.1);
        -webkit-transform: scale(1.1);
        box-shadow: 0 0 30px rgba(249,0,91,0.5);
    }
    .btn-nav-slider:disabled {
        opacity: 0.2;
        cursor: not-allowed;
        transform: scale(0.9);
        -webkit-transform: scale(0.9);
    }
    /* Progress bar slider */
    .slider-progress-bg {
        width: 200px;
        height: 2px;
        background: rgba(255,255,255,0.1);
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }
    .slider-progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 20%;
        background: #f9005b;
        box-shadow: 0 0 10px #f9005b;
        transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }

    /* 4. Tech Card Spotlight & Buttons */
    .slide-item {
        position: relative;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .slide-item::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 10;
        pointer-events: none;
        background: -webkit-radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(249,0,91,0.15), transparent 40%);
        background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(249,0,91,0.15), transparent 40%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .slide-item:hover::before {
        opacity: 1;
    }
    
    /* 5. Chaos Card Style */
    .animate-gradient-xy {
        background-size: 300% 300%;
        animation: gradientXY 6s ease infinite;
    }
    @keyframes gradientXY {
        0% { background-position: 0% 0%; }
        50% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
    }
    .tech-pattern-overlay::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: -webkit-radial-gradient(rgba(255, 255, 255, 0.25) 1px, transparent 1px);
        background-image: radial-gradient(rgba(255, 255, 255, 0.25) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
        z-index: 1;
    }

    /* 6. Scary Face & City */
    #scary-section, #city-section, #astronaut-canvas {
        cursor: crosshair;
    }
    #scene-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .disable-selection {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
    }

    /* 7. Marquee Safari Fix */
    .marquee-wrapper {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }
    .marquee-wrapper::before, .marquee-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
    }
    .marquee-wrapper::before {
        left: 0;
        background: -webkit-linear-gradient(left, #080815 0%, transparent 100%);
        background: linear-gradient(to right, #080815 0%, transparent 100%);
    }
    .marquee-wrapper::after {
        right: 0;
        background: -webkit-linear-gradient(right, #080815 0%, transparent 100%);
        background: linear-gradient(to left, #080815 0%, transparent 100%);
    }
    .marquee-content {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        animation: scroll-marquee 40s linear infinite;
        width: -webkit-max-content;
        width: max-content;
        will-change: transform;
    }
    .marquee-content:hover {
        animation-play-state: paused;
    }
    @keyframes scroll-marquee {
        0% { transform: translate3d(0, 0, 0); -webkit-transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-50%, 0, 0); -webkit-transform: translate3d(-50%, 0, 0); }
    }
    .client-brand {
        opacity: 0.3;
        transition: all 0.4s ease;
        cursor: pointer;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .client-brand:hover {
        opacity: 1;
        color: #f9005b;
        transform: scale(1.1);
        -webkit-transform: scale(1.1);
        text-shadow: 0 0 20px rgba(249,0,91,0.6);
    }
</style>

<!-- SECTION 1: THE HOOK (Hero Section) -->
<section id="hero-section" class="relative w-full h-screen overflow-hidden flex items-center justify-center bg-[#1a1a2e]">
    <video id="hero-video" autoplay loop muted playsinline webkit-playsinline muted="muted" class="absolute inset-0 w-full h-full object-cover opacity-0 z-0">
        <source src="{{ asset('assets/video/3d-home-page.mp4') }}" type="video/mp4">
    </video>
    
    <div id="hero-text" class="relative z-10 text-center px-4 w-full max-w-5xl mx-auto opacity-0 scale-90 will-change-transform flex flex-col items-center">
        <!-- Eyebrow Tag -->
        <div class="mb-6 inline-flex items-center gap-3 px-5 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-md shadow-[0_0_20px_rgba(255,255,255,0.05)]">
            <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse shadow-[0_0_10px_#f9005b]"></span>
            <span class="text-xs md:text-sm font-mono text-gray-300 tracking-[0.2em] uppercase">Creative Technology Studio</span>
        </div>

        <!-- Headline -->
        <h1 class="text-6xl md:text-8xl lg:text-[9rem] text-white mb-6 drop-shadow-2xl leading-none" style="font-family: 'Lobster', cursive; text-shadow: 0 15px 40px rgba(0,0,0,0.8);">
            Beyond The <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] via-[#ff0055] to-[#9d00ff] pr-4">Canvas</span>
        </h1>

        <!-- Subheadline -->
        <p class="text-base md:text-xl text-gray-300 font-sans max-w-3xl mx-auto leading-relaxed font-light text-shadow-sm mt-4">
            Eksplorasi dimensi baru. Kami menerjemahkan narasi brand Anda ke dalam arsitektur visual interaktif dan ekosistem WebGL yang hidup.
        </p>

        <!-- CTA Arrow Down -->
        <div class="mt-12 animate-bounce opacity-70">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>

    <div class="absolute inset-0 z-20 pointer-events-none flex items-center justify-center overflow-hidden">
        <img id="door-image" 
                src="{{ asset('assets/images/fantasy-style-entryway-door-with-desert-landscape.png') }}" 
                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2000&auto=format&fit=crop'; this.style.webkitClipPath='polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 0%, 35% 25%, 35% 75%, 65% 75%, 65% 25%, 35% 25%)'; this.style.clipPath='polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 0%, 35% 25%, 35% 75%, 65% 75%, 65% 25%, 35% 25%)';"
                class="w-full h-full object-cover transform-gpu origin-center will-change-transform" 
                alt="Entryway Door">
    </div>
</section>

<!-- SECTION 2: THE MANIFESTO (Glitch Section) -->
<section id="glitch-section" class="relative w-full h-screen bg-white flex items-center justify-center overflow-hidden z-30">
    <div id="boring-state" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-100 z-20 will-change-transform px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-sans text-gray-400 font-light mb-4">The Static Brochure.</h2>
        <p class="text-gray-400 font-sans max-w-xl">Teks datar, gambar diam, dan susunan template standar. Sangat aman, dan perlahan menidurkan audiens Anda.</p>
    </div>
    
    <div id="chaos-state" class="absolute inset-0 flex flex-col items-center justify-center z-10 opacity-0 transform scale-110 will-change-transform px-4 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/img4.jpg') }}');">
        <div class="absolute inset-0 bg-black/70 z-0 pointer-events-none"></div>

        <div class="glitch-wrapper relative z-10">
            <h2 class="glitch-text text-5xl md:text-8xl lg:text-9xl text-center leading-none" data-text="STATIC IS DEAD">STATIC IS DEAD</h2>
        </div>
        <p class="text-[#f9005b] mt-6 text-xl md:text-2xl font-mono tracking-widest uppercase animate-pulse text-center relative z-10">Berhenti membuat website yang membosankan.</p>
    </div>
</section>

<!-- SECTION 3: THE CAPABILITIES (ADVANCED GSAP SLIDER) -->
<section id="layanan" class="py-24 text-white overflow-hidden relative z-30 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/img5.jpg') }}');">
    <div class="absolute inset-0 bg-black/80 z-0 pointer-events-none"></div>

    <div class="absolute top-10 left-[10%] w-[30rem] h-[30rem] bg-[#f9005b]/20 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>
    <div class="absolute bottom-10 right-[10%] w-[30rem] h-[30rem] bg-[#9d00ff]/20 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
        <div class="text-left mb-12">
            <h2 class="text-4xl md:text-6xl font-normal mb-4 text-[#f9005b] drop-shadow-lg tracking-wide" style="font-family: 'Lobster', cursive;">Core Capabilities</h2>
            <p class="text-lg text-gray-300 max-w-2xl font-mono tracking-wide">Keahlian teknis dan kreatif kami untuk membangun ekosistem digital yang solid.</p>
        </div>
        
        <!-- Viewport Slider GSAP -->
        <div class="slider-viewport">
            <div id="slider-track" class="slider-track">
                
                <!-- Card 1: UI/UX -->
                <article class="slide-item shrink-0 w-[85vw] md:w-[380px] h-[520px] flex flex-col rounded-[2rem] overflow-hidden relative group bg-[#0a0a14]/60 backdrop-blur-xl border border-white/10 hover:border-[#f9005b]/50 shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-500">
                    <div class="h-[55%] w-full relative overflow-hidden z-10">
                        <div class="absolute top-5 left-5 z-20">
                            <div class="px-4 py-2 bg-black/60 backdrop-blur-md border border-white/10 rounded-full font-mono text-[10px] text-white tracking-[0.2em] flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f9005b] animate-pulse"></span>
                                CAP_01
                            </div>
                        </div>
                        <img src="{{ asset('assets/images/ui-ux-representations-with-laptop.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="UI/UX">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#0a0a14]/90 to-transparent"></div>
                    </div>
                    <div class="p-8 pt-4 flex-1 flex flex-col justify-start relative z-10">
                        <h3 class="text-3xl font-black text-white mb-3 tracking-wide uppercase italic group-hover:text-[#f9005b] transition-colors">Immersive UI/UX</h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-sans font-light">Desain antarmuka yang berfokus pada estetika premium dan alur pengguna yang intuitif. Membawa audiens tenggelam dalam pengalaman digital.</p>
                    </div>
                </article>

                <!-- Card 2: Web Dev -->
                <article class="slide-item shrink-0 w-[85vw] md:w-[380px] h-[520px] flex flex-col rounded-[2rem] overflow-hidden relative group bg-[#0a0a14]/60 backdrop-blur-xl border border-white/10 hover:border-[#9d00ff]/50 shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-500">
                    <div class="h-[55%] w-full relative overflow-hidden z-10">
                        <div class="absolute top-5 left-5 z-20">
                            <div class="px-4 py-2 bg-black/60 backdrop-blur-md border border-white/10 rounded-full font-mono text-[10px] text-white tracking-[0.2em] flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#9d00ff] animate-pulse"></span>
                                CAP_02
                            </div>
                        </div>
                        <img src="{{ asset('assets/images/web-dev.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Web Dev">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#0a0a14]/90 to-transparent"></div>
                    </div>
                    <div class="p-8 pt-4 flex-1 flex flex-col justify-start relative z-10">
                        <h3 class="text-3xl font-black text-white mb-3 tracking-wide uppercase italic group-hover:text-[#9d00ff] transition-colors">Creative Web Dev</h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-sans font-light">Pengembangan frontend dengan performa optimal, animasi halus, dan arsitektur kode modern. Perpaduan desain dan rekayasa perangkat lunak.</p>
                    </div>
                </article>

                <!-- Card 3: 3D & Motion -->
                <article class="slide-item shrink-0 w-[85vw] md:w-[380px] h-[520px] flex flex-col rounded-[2rem] overflow-hidden relative group bg-[#0a0a14]/60 backdrop-blur-xl border border-white/10 hover:border-[#f9005b]/50 shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-500">
                    <div class="h-[55%] w-full relative overflow-hidden z-10">
                        <div class="absolute top-5 left-5 z-20">
                            <div class="px-4 py-2 bg-black/60 backdrop-blur-md border border-white/10 rounded-full font-mono text-[10px] text-white tracking-[0.2em] flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f9005b] animate-pulse"></span>
                                CAP_03
                            </div>
                        </div>
                        <img src="{{ asset('assets/images/img5.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="3D & Motion">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#0a0a14]/90 to-transparent"></div>
                    </div>
                    <div class="p-8 pt-4 flex-1 flex flex-col justify-start relative z-10">
                        <h3 class="text-3xl font-black text-white mb-3 tracking-wide uppercase italic group-hover:text-[#f9005b] transition-colors">3D & Motion</h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-sans font-light">Integrasi aset 3D kustom dan motion graphics tingkat lanjut untuk menghidupkan identitas visual brand Anda secara dramatis.</p>
                    </div>
                </article>

                <!-- Card 4: Campaigns -->
                <article class="slide-item shrink-0 w-[85vw] md:w-[380px] h-[520px] flex flex-col rounded-[2rem] overflow-hidden relative group bg-[#0a0a14]/60 backdrop-blur-xl border border-white/10 hover:border-[#9d00ff]/50 shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-500">
                    <div class="h-[55%] w-full relative overflow-hidden z-10">
                        <div class="absolute top-5 left-5 z-20">
                            <div class="px-4 py-2 bg-black/60 backdrop-blur-md border border-white/10 rounded-full font-mono text-[10px] text-white tracking-[0.2em] flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#9d00ff] animate-pulse"></span>
                                CAP_04
                            </div>
                        </div>
                        <img src="{{ asset('assets/images/digital-campaign.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Campaigns">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#0a0a14]/90 to-transparent"></div>
                    </div>
                    <div class="p-8 pt-4 flex-1 flex flex-col justify-start relative z-10">
                        <h3 class="text-3xl font-black text-white mb-3 tracking-wide uppercase italic group-hover:text-[#9d00ff] transition-colors">Digital Campaigns</h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-sans font-light">Strategi interaktif dan aktivasi digital yang dirancang untuk memperkuat keterlibatan audiens dengan narasi brand yang kuat.</p>
                    </div>
                </article>

                <!-- Card 5: Brand Direction -->
                <article class="slide-item shrink-0 w-[85vw] md:w-[380px] h-[520px] flex flex-col rounded-[2rem] overflow-hidden relative group bg-[#0a0a14]/60 backdrop-blur-xl border border-white/10 hover:border-[#f9005b]/50 shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-500">
                    <div class="h-[55%] w-full relative overflow-hidden z-10">
                        <div class="absolute top-5 left-5 z-20">
                            <div class="px-4 py-2 bg-black/60 backdrop-blur-md border border-white/10 rounded-full font-mono text-[10px] text-white tracking-[0.2em] flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f9005b] animate-pulse"></span>
                                CAP_05
                            </div>
                        </div>
                        <img src="{{ asset('assets/images/art-directors.webp') }}" onerror="this.onerror=null; this.src='https://cdn-front.freepik.com/home/anon-rvmp/professionals/art-directors.webp';" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Brand Direction">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#0a0a14]/90 to-transparent"></div>
                    </div>
                    <div class="p-8 pt-4 flex-1 flex flex-col justify-start relative z-10">
                        <h3 class="text-3xl font-black text-white mb-3 tracking-wide uppercase italic group-hover:text-[#f9005b] transition-colors">Brand Direction</h3>
                        <p class="text-gray-400 text-sm leading-relaxed font-sans font-light">Arahan visual yang konsisten untuk memastikan karakter eksklusif brand Anda tetap terjaga di setiap titik sentuh digital.</p>
                    </div>
                </article>

            </div>
        </div>

        <!-- Controls Slider GSAP -->
        <div class="flex flex-col items-center gap-8 mt-12 relative z-20">
            <div class="flex items-center gap-6">
                <button id="prev-slide" class="btn-nav-slider">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <!-- Progress Line -->
                <div class="slider-progress-bg hidden md:block">
                    <div id="slider-progress" class="slider-progress-fill"></div>
                </div>

                <button id="next-slide" class="btn-nav-slider">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- SECTION ASTRONAUT 3D -->
<section id="astronaut-section" class="relative w-full h-screen bg-[#05050a] flex items-center justify-center overflow-hidden z-30 border-t border-white/10">
    
    <!-- Container Canvas 3D -->
    <div id="astronaut-canvas" class="absolute inset-0 w-full h-full cursor-move z-10"></div>

    <!-- Teks Overlay -->
    <div class="absolute z-20 text-center pointer-events-none px-4 flex flex-col items-center">
        <div class="mb-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-[#9d00ff] animate-pulse"></span>
            <span class="text-xs font-mono text-gray-300 tracking-widest uppercase">Pioneer The Future</span>
        </div>
        <h2 class="text-6xl md:text-8xl lg:text-[9rem] text-white drop-shadow-2xl leading-none" style="font-family: 'Lobster', cursive;">
            Limitless <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Exploration</span>
        </h2>
        <p class="mt-6 font-sans text-gray-400 text-sm md:text-base max-w-lg bg-[#0a0a14]/60 p-4 rounded-2xl border border-white/5 backdrop-blur-sm font-light">
            [ INTERACT ] Geser layar untuk mengeksplorasi dimensi. Kami membawa brand Anda melampaui batasan konvensional.
        </p>
    </div>

    <!-- Loading Indikator -->
    <div id="astro-loader" class="absolute z-30 flex flex-col items-center gap-3 transition-opacity duration-500">
        <div class="w-10 h-10 border-2 border-white/20 border-t-[#f9005b] rounded-full animate-spin"></div>
        <span class="text-xs font-mono text-[#f9005b] tracking-widest uppercase animate-pulse">Memuat Aset 3D...</span>
    </div>
</section>

<!-- SECTION 4: THE SHOWCASE (Portaplane / Scary Face / City 3D) -->
<section id="section-portaplane" class="relative w-full h-[95vh] bg-black flex items-center justify-center overflow-hidden z-30 border-t border-white/10">
    <div id="portaplane-canvas-wrapper" class="absolute inset-0 w-full h-full block">
        
        <div class="portaplane-instructions absolute bottom-28 left-1/2 transform -translate-x-1/2 z-[100] text-center w-full max-w-4xl px-4 pointer-events-none flex flex-col items-center">
            <h2 class="text-5xl md:text-7xl mb-4 text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff] drop-shadow-2xl" style="font-family: 'Lobster', cursive; padding-bottom: 5px;">Spatial Interaction</h2>
            <p class="text-sm md:text-base text-gray-200 bg-black/60 inline-block px-8 py-4 rounded-3xl backdrop-blur-md border border-white/10 shadow-2xl mt-2 font-light">
                Eksplorasi kedalaman visual. Gunakan mouse atau sensor perangkat Anda untuk berinteraksi dengan kanvas 3D di bawah ini.
            </p>
        </div>

        <div id="controls-panel" class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-[100] flex gap-3 bg-[#f9005b]/20 backdrop-blur-xl p-3 rounded-2xl border border-[#f9005b]/40 shadow-[0_10px_30px_rgba(249,0,91,0.2)]">
            <button id="mouse-control-btn" class="control-btn active bg-[#f9005b] text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all hover:bg-pink-600 shadow-md">Mouse</button>
            <button id="gyro-control-btn" class="control-btn bg-[#080815] text-white hover:bg-[#1a1a2e] border border-white/10 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all hover:text-[#f9005b]">Gyroscope</button>
            <button id="calibrate-btn" class="control-btn bg-[#080815] text-white hover:bg-[#1a1a2e] border border-white/10 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all hover:text-[#f9005b]" style="display: none;">Calibrate</button>
        </div>

        <div id="permission-message" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#080815]/90 backdrop-blur-xl text-white p-8 rounded-2xl text-center z-[101] border border-white/20 shadow-2xl" style="display:none;">
            <p class="mb-6 text-lg text-gray-200">To use gyroscope, we need permission:</p>
            <button id="request-permission-btn" class="bg-[#f9005b] hover:bg-pink-600 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg hover:-translate-y-1">Allow Motion Sensor Access</button>
        </div>
    </div>
</section>

<!-- Kinetic Typography Transition -->
<section id="kinetic-section" class="py-20 md:py-32 bg-[#080815] relative overflow-hidden flex flex-col justify-center min-h-[70vh] z-30">
    <div class="absolute inset-0 pointer-events-none bg-gradient-to-r from-[#080815] via-transparent to-[#080815] z-10 w-full h-full"></div>
    <div class="flex flex-col gap-2 md:gap-6 transform -rotate-3 scale-110">
        <div class="kinetic-row marquee-left flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[10rem] font-black uppercase tracking-tighter w-max will-change-transform" style="transform: translateX(-10%);">
            <span class="kinetic-word text-outline">Imagine.</span>
            <span class="kinetic-word text-outline">Imagine.</span>
            <span class="kinetic-word text-outline">Imagine.</span>
            <span class="kinetic-word text-outline">Imagine.</span>
            <span class="kinetic-word text-outline">Imagine.</span>
        </div>
        <div class="kinetic-row marquee-right flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[10rem] font-black uppercase tracking-tighter w-max will-change-transform" style="transform: translateX(-25%);">
            <span class="kinetic-word text-outline">Create.</span>
            <span class="kinetic-word text-outline">Create.</span>
            <span class="kinetic-word text-outline">Create.</span>
            <span class="kinetic-word text-outline">Create.</span>
            <span class="kinetic-word text-outline">Create.</span>
        </div>
        <div class="kinetic-row marquee-left flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[10rem] font-black uppercase tracking-tighter w-max will-change-transform" style="transform: translateX(-5%);">
            <span class="kinetic-word text-outline">Elevate.</span>
            <span class="kinetic-word text-outline">Elevate.</span>
            <span class="kinetic-word text-outline">Elevate.</span>
            <span class="kinetic-word text-outline">Elevate.</span>
            <span class="kinetic-word text-outline">Elevate.</span>
        </div>
    </div>
</section>

<!-- Text Scary Face (Mobile Only) -->
<section class="block md:hidden pt-20 pb-8 px-6 bg-black relative z-30 border-t border-white/5">
    <div class="mb-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#f9005b]/30 bg-[#f9005b]/10 backdrop-blur-md">
        <span class="text-xs font-mono text-[#f9005b] tracking-widest uppercase">/// 3D Integration</span>
    </div>
    <h3 class="text-5xl text-white leading-tight drop-shadow-2xl mb-4" style="font-family: 'Lobster', cursive;">
        Breaking <br>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff] pr-4">Flat Interfaces</span>
    </h3>
    <p class="font-sans text-gray-300 text-sm bg-[#0a0a14]/60 p-5 rounded-3xl border border-white/10 shadow-2xl leading-relaxed font-light">
        Mendobrak batasan desain 2D. Kami menghadirkan objek kustom dan pengalaman spasial langsung ke dalam peramban web Anda.
    </p>
</section>

<!-- Scary Face Demonstration -->
<section id="scary-section" class="relative w-full h-[60vh] md:h-screen bg-black flex items-center justify-center overflow-hidden z-30 border-t md:border-t-0 border-white/5">
    <div id="scene-container"></div>
    
    <div class="hidden md:block absolute top-12 left-6 md:top-24 md:left-24 z-20 pointer-events-none">
        <div class="mb-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#f9005b]/30 bg-[#f9005b]/10 backdrop-blur-md">
            <span class="text-xs md:text-sm font-mono text-[#f9005b] tracking-widest uppercase">/// 3D Integration</span>
        </div>
        <h3 class="text-5xl md:text-7xl lg:text-[6rem] text-white leading-tight drop-shadow-2xl" style="font-family: 'Lobster', cursive;">
            Breaking <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff] pr-4">Flat Interfaces</span>
        </h3>
        <p class="mt-6 font-sans text-gray-300 text-sm md:text-base max-w-md bg-[#0a0a14]/60 p-6 rounded-3xl border border-white/10 backdrop-blur-xl shadow-2xl leading-relaxed font-light">
            Mendobrak batasan desain 2D. Kami menghadirkan objek kustom dan pengalaman spasial langsung ke dalam peramban web Anda.
        </p>
    </div>

    <div class="absolute bottom-6 md:bottom-10 left-6 md:left-24 z-10 text-xs md:text-sm text-gray-300 font-mono pointer-events-none bg-[#0a0a14]/80 px-5 py-3 rounded-full border border-white/10 flex items-center gap-3 backdrop-blur-md shadow-lg">
        <span class="w-2.5 h-2.5 rounded-full bg-[#f9005b] animate-ping relative"><span class="absolute inset-0 bg-[#f9005b] rounded-full"></span></span>
        <span class="md:hidden">[ INTERACT ] Touch & drag</span>
        <span class="hidden md:inline">[ INTERACT ] Touch & drag the canvas.</span>
    </div>
</section>

<!-- Lab City 3D -->
<section id="city-section" class="relative w-full h-screen bg-[#F02050] overflow-hidden z-30 disable-selection">
    <div id="city-canvas-wrapper" class="absolute inset-0 w-full h-full block"></div>
    
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 pointer-events-none text-center w-full px-4 flex flex-col items-center">
        <h2 class="text-6xl md:text-8xl text-white mb-2 drop-shadow-2xl" style="font-family: 'Lobster', cursive; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            WebGL Environments
            <sup class="text-xs bg-black/80 text-[#f9005b] px-3 py-1.5 rounded-lg ml-2 font-mono tracking-widest relative -top-6 md:-top-10 border border-[#f9005b]/30">THREE.JS</sup>
        </h2>
        <div class="mt-8 inline-block bg-black/30 p-6 px-10 rounded-3xl backdrop-blur-md border border-white/10 shadow-2xl">
            <p class="text-[#f9005b] tracking-[0.3em] uppercase font-mono text-xs md:text-sm font-bold mb-3">
                — Immersive Digital Worlds —
            </p>
            <p class="text-gray-200 font-sans text-sm md:text-base max-w-xl mx-auto leading-relaxed font-light">
                Membangun dunia digital interaktif skala besar. Dioptimalkan untuk performa tinggi, dirancang untuk standar masa depan arsitektur web.
            </p>
        </div>
    </div>
</section>

<!-- SECTION 5: SELECTED WORKS (GEELY CASE STUDY) -->
<section id="lab-section" class="py-24 md:py-32 bg-[#080815] relative z-30 border-t border-white/5 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[80%] h-32 bg-[#9d00ff]/20 blur-[100px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-0 w-1/3 h-full bg-gradient-to-r from-[#0a0a14] to-transparent z-10 pointer-events-none"></div>

    <div class="max-w-[90rem] mx-auto px-6 lg:px-12 relative z-20">
        
        <div class="text-center mb-24">
            <h2 class="text-5xl md:text-7xl font-normal text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff] mb-6 tracking-wide drop-shadow-2xl" style="font-family: 'Lobster', cursive; padding-right: 15px;">Selected Works</h2>
            <p class="text-gray-400 text-sm md:text-base font-light tracking-wide max-w-2xl mx-auto">Kumpulan studi kasus di mana estetika visual berpadu dengan presisi teknis untuk memecahkan tantangan bisnis yang nyata.</p>
        </div>

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
                    Pengembangan platform otomotif berkinerja tinggi. Kami membangun ekosistem digital Geely untuk regional Fatmawati dan BSD dengan fokus pada interaksi imersif, kecepatan loading, dan konversi test-drive.
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
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
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
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <button class="load-iframe-btn flex items-center gap-3 bg-black/50 backdrop-blur-md border border-[#9d00ff] text-[#9d00ff] px-8 py-3.5 rounded-full font-bold hover:bg-[#9d00ff] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(157,0,255,0.2)] hover:shadow-[0_0_30px_rgba(157,0,255,0.6)] cursor-pointer" data-url="https://geelybsd.id">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Launch Experience
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-32 text-center">
            <a href="{{ url('/portfolio') }}" class="inline-flex items-center gap-3 text-white border border-white/20 bg-white/5 backdrop-blur-sm px-8 py-4 rounded-full font-bold hover:bg-white hover:text-black transition-all duration-300 shadow-lg">
                View All Projects
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>

<!-- SECTION 6 & 7 MERGED: THE VIBE CONFIGURATOR & CTA -->
<section id="vibe-section" class="py-24 md:py-32 relative transition-all duration-700 flex flex-col items-center justify-center z-30" style="background-color: #f8f9fa; color: #333333;">
    <h2 id="vibe-title" class="text-4xl md:text-6xl font-bold mb-12 transition-all duration-500 text-center px-4" style="font-family: sans-serif; font-weight: normal;">The Safe Zone.</h2>
    
    <div class="w-full max-w-[90rem] mx-auto px-6 flex flex-col items-center gap-8 md:gap-16">
        
        <!-- UI Control (Housing) -->
        <div class="relative w-full max-w-4xl p-8 md:p-12 rounded-[2.5rem] border border-gray-400/30 bg-gray-500/5 backdrop-blur-2xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden group transition-colors duration-500" id="vibe-housing">
            
            <div class="absolute inset-0 bg-gradient-to-r from-[#f9005b]/5 via-[#9d00ff]/5 to-[#ff0055]/5 opacity-50 blur-3xl pointer-events-none"></div>

            <div class="absolute top-6 left-8 flex items-center gap-2 pointer-events-none">
                <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse"></span>
                <span class="text-[10px] font-mono tracking-widest opacity-60 uppercase font-bold">System Vibe Control</span>
            </div>
            
            <div class="relative z-10 mt-12 mb-8">
                 <div class="absolute w-full flex justify-between top-1/2 -translate-y-1/2 px-[10px] pointer-events-none opacity-30 z-0">
                     <div class="h-6 w-1 bg-current rounded-full"></div>
                     <div class="h-6 w-1 bg-current rounded-full"></div>
                     <div class="h-6 w-1 bg-current rounded-full"></div>
                 </div>
                 
                 <input type="range" id="vibe-slider" min="0" max="100" value="0" class="advanced-slider relative z-20 w-full">
            </div>

            <div class="flex justify-between w-full mt-4 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-inherit opacity-80 font-mono relative z-10">
                <span class="text-left w-1/3 cursor-pointer hover:text-[#f9005b] transition-colors" onclick="document.getElementById('vibe-slider').value=0; document.getElementById('vibe-slider').dispatchEvent(new Event('input'));">Biasa</span>
                <span class="text-center w-1/3 cursor-pointer hover:text-[#9d00ff] transition-colors" onclick="document.getElementById('vibe-slider').value=50; document.getElementById('vibe-slider').dispatchEvent(new Event('input'));">Menengah</span>
                <span class="text-right w-1/3 cursor-pointer hover:text-[#ff0055] transition-colors" onclick="document.getElementById('vibe-slider').value=100; document.getElementById('vibe-slider').dispatchEvent(new Event('input'));">Brutal</span>
            </div>
        </div>
        
        <!-- CTA Card yang Merespon Slider -->
        <div id="cta-card" class="bg-white rounded-xl p-10 md:p-16 text-center shadow-md relative overflow-hidden border border-gray-200 transition-all duration-500 max-w-4xl mx-auto mt-8 w-full">
            <h2 id="cta-heading" class="text-3xl font-bold text-gray-800 mb-4" style="font-family: sans-serif;">Ready to Start?</h2>
            <p id="cta-desc" class="text-gray-600 mb-8 font-sans text-base tracking-normal border-none bg-transparent p-0 max-w-2xl mx-auto">
                Pendekatan standar yang teruji. Aman, fungsional, dan langsung pada tujuannya. Hubungi kami untuk berkonsultasi.
            </p>
            
            <a href="mailto:rizkialiakhbar@gmail.com" id="vibe-btn" class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded hover:bg-blue-700 transition-colors shadow-none border-none relative z-10 text-sm uppercase tracking-widest">
                Contact Us
            </a>
        </div>
        
    </div>
</section>

<!-- Our Clients Marquee -->
<section id="clients-section" class="py-24 bg-[#080815] relative z-30 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10 mb-16">
        <div class="text-center">
            <h2 class="text-5xl md:text-6xl font-normal text-white tracking-wide mb-4 drop-shadow-lg" style="font-family: 'Lobster', cursive;">Our Partners</h2>
            <p class="text-gray-400 font-mono text-sm tracking-[0.2em] uppercase">Merek dan inovator yang telah memercayakan visinya kepada kami.</p>
        </div>
    </div>

    <div class="marquee-wrapper w-full py-8">
        <div class="marquee-content gap-16 md:gap-32 px-16">
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>
            
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>

            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>
        </div>
    </div>
</section>

<!-- Memuat Dependensi JavaScript Eksternal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>

<!-- Script Keseluruhan -->
<script src="{{ asset('js/home-main.js') }}"></script>

<!-- Polyfill ES Module Shims Khusus Safari agar mendukung importmap -->
<script async src="https://cdn.jsdelivr.net/npm/es-module-shims@1.8.0/dist/es-module-shims.js"></script>

<!-- Import Map Baru Khusus Untuk Scary Scene & Astronaut -->
<script type="importmap">
    {
        "imports": {
            "three": "https://cdn.jsdelivr.net/npm/three@0.164/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.164/examples/jsm/"
        }
    }
</script>

<script type="module" src="{{ asset('js/home-scary.js') }}"></script>
<script type="module" src="{{ asset('js/home-astronaut.js') }}"></script>

<!-- SCRIPT UNTUK LIVE PREVIEW IFRAME -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                <div id="modal-loader" class="absolute inset-0 flex flex-col items-center justify-center bg-[#080815] z-10 transition-opacity duration-300">
                    <div class="w-12 h-12 border-4 border-white/10 border-t-[#f9005b] rounded-full animate-spin mb-4"></div>
                    <p class="text-gray-400 font-mono text-sm tracking-widest animate-pulse">Menghubungkan...</p>
                </div>
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
    });
</script>
@endsection