@extends('layouts.main')

@section('title', 'Home - Lund\'or Imagine Digital')

@section('content')
<!-- Mengambil font khusus dari desain Anda -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

<!-- CSS Khusus -->
<style>
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

    /* --- CSS BARU UNTUK IDE LIAR --- */
    
    /* Optimasi Animasi GPU */
    .will-change-transform {
        will-change: transform;
    }

    /* 1. Glitch Effect CSS (DIKEMBALIKAN) */
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
        background: black;
        will-change: clip;
    }
    .glitch-text::before {
        left: 3px;
        text-shadow: -2px 0 #f9005b;
        clip: rect(24px, 550px, 90px, 0);
        animation: glitch-anim 3s infinite linear alternate-reverse;
        z-index: -1;
    }
    .glitch-text::after {
        left: -3px;
        text-shadow: -2px 0 #0ff;
        clip: rect(85px, 550px, 140px, 0);
        animation: glitch-anim 2s infinite linear alternate-reverse;
        z-index: -2;
    }
    @keyframes glitch-anim {
        0% { clip: rect(10px, 9999px, 83px, 0); }
        20% { clip: rect(61px, 9999px, 34px, 0); }
        40% { clip: rect(23px, 9999px, 98px, 0); }
        60% { clip: rect(88px, 9999px, 12px, 0); }
        80% { clip: rect(4px, 9999px, 76px, 0); }
        100% { clip: rect(50px, 9999px, 30px, 0); }
    }

    /* 2. Vibe Configurator Slider Styling */
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #f9005b;
        cursor: pointer;
        box-shadow: 0 0 15px rgba(249,0,91,0.8);
        transition: transform 0.2s;
    }
    input[type=range]::-webkit-slider-thumb:hover {
        transform: scale(1.2);
    }

    /* 3. Tech Card Spotlight & Buttons (Canggih) */
    .tech-card {
        position: relative;
    }
    .tech-card::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 10;
        pointer-events: none;
        /* Custom property --mouse-x & --mouse-y disuntik via JS */
        background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(249,0,91,0.15), transparent 40%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .tech-card:hover::before {
        opacity: 1;
    }
    
    .btn-gradient-border {
        background: linear-gradient(#0a0a14, #0a0a14) padding-box,
                    linear-gradient(45deg, #f9005b, #9d00ff) border-box;
        border: 1px solid transparent;
    }
    .btn-gradient-border:hover {
        background: linear-gradient(45deg, #f9005b, #9d00ff) padding-box,
                    linear-gradient(45deg, #f9005b, #9d00ff) border-box;
        box-shadow: 0 0 20px rgba(249,0,91,0.4);
    }

    /* 4. Canggih Chaos Card Style */
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
        background-image: radial-gradient(rgba(255, 255, 255, 0.25) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
        z-index: 1;
    }

    /* --- CSS BARU: SCARY FACE --- */
    #scary-section, #city-section {
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
        -moz-user-select: none;
        -ms-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        -webkit-touch-callout: none;
    }

    /* --- CSS BARU: MARQUEE CLIENTS --- */
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
    }
    .marquee-content:hover {
        animation-play-state: paused;
    }
    @keyframes scroll-marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .client-brand {
        opacity: 0.3;
        transition: all 0.4s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .client-brand:hover {
        opacity: 1;
        color: #f9005b;
        transform: scale(1.1);
        text-shadow: 0 0 20px rgba(249,0,91,0.6);
    }
</style>

<!-- Section 1: Hero Section dengan Efek "Zoom Through Door" -->
<section id="hero-section" class="relative w-full h-screen overflow-hidden flex items-center justify-center bg-[#1a1a2e]">
    
    <video id="hero-video" autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-60 z-0">
        <source src="{{ asset('assets/video/3d-home-page.mp4') }}" type="video/mp4">
    </video>
    
    <div id="hero-text" class="relative z-10 text-center px-4 w-full opacity-0 scale-90 will-change-transform">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-normal text-white mb-2 tracking-wide drop-shadow-2xl" style="font-family: 'Lobster', cursive; text-shadow: -6px 6px 12px rgba(0, 0, 0, 0.4);">
            Creativity Is Our
        </h1>
        <p class="text-4xl md:text-6xl lg:text-7xl text-[#f9005b] font-bold italic drop-shadow-2xl" style="text-shadow: -6px 6px 12px rgba(0, 0, 0, 0.8);">
            Super Power
        </p>
    </div>

    <div class="absolute inset-0 z-20 pointer-events-none flex items-center justify-center overflow-hidden">
        <img id="door-image" 
                src="{{ asset('assets/images/fantasy-style-entryway-door-with-desert-landscape.png') }}" 
                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2000&auto=format&fit=crop'; this.style.clipPath='polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 0%, 35% 25%, 35% 75%, 65% 75%, 65% 25%, 35% 25%)';"
                class="w-full h-full object-cover transform-gpu origin-center will-change-transform" 
                alt="Entryway Door">
    </div>

</section>

<!-- Section 2: Professionals / Slider Section -->
<section id="layanan" class="py-24 bg-[#080815] text-white overflow-hidden relative z-30">
    <div class="absolute top-10 left-[10%] w-[30rem] h-[30rem] bg-[#f9005b]/20 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>
    <div class="absolute bottom-10 right-[10%] w-[30rem] h-[30rem] bg-[#9d00ff]/20 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
        <div class="text-left mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-4xl md:text-5xl font-normal mb-4 text-[#f9005b] drop-shadow-lg" style="font-family: 'Lobster', cursive;">Explore Our Roles</h2>
                <p class="text-lg text-gray-300 max-w-2xl text-shadow-sm">Tools and creative control tailored specifically for how you work.</p>
            </div>
            <div class="hidden md:flex gap-2">
                <span class="text-gray-300 text-sm flex items-center gap-2">
                    Drag/Swipe to explore 
                    <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </span>
            </div>
        </div>
        
        <div id="roles-slider" class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-16 pt-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] cursor-grab select-none">
            <!-- Card 1: Designers -->
            <article class="tech-card snap-center shrink-0 w-[85vw] md:w-[380px] h-[480px] rounded-[2.5rem] overflow-hidden relative group bg-[#0a0a14] border border-white/5 hover:border-white/20 shadow-[0_15px_35px_rgba(0,0,0,0.8)] transition-all duration-500 pointer-events-none md:pointer-events-auto transform-gpu">
                <div class="absolute inset-[1px] rounded-[2.4rem] border border-white/0 group-hover:border-[#f9005b]/30 pointer-events-none z-20 transition-colors duration-500"></div>
                
                <div class="absolute inset-0 z-0">
                    <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/designers.webp" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-60 mix-blend-lighten transition-all duration-700 will-change-transform" alt="Designers BG">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] via-[#0a0a14]/80 to-transparent"></div>
                </div>

                <!-- Tech Accents UI -->
                <div class="absolute top-6 left-6 flex items-center gap-2 z-20 opacity-50 group-hover:opacity-100 transition-opacity">
                    <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse"></span>
                    <span class="text-xs font-mono text-white tracking-widest">ID_01</span>
                </div>
                <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-50 transition-opacity duration-500 delay-100 font-mono text-[10px] text-right text-white">
                    SYS.OP // OK<br>RDY_
                </div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="relative w-20 h-20 mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="absolute inset-0 rounded-2xl border border-white/20 group-hover:border-[#f9005b] group-hover:shadow-[0_0_20px_rgba(249,0,91,0.4)] transition-all duration-500 z-10"></div>
                        <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/img-designer.webp?w=480" class="w-full h-full rounded-2xl object-cover p-1 relative z-0" alt="Designers">
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 tracking-tight">Designers</h3>
                    <p class="text-gray-400 mb-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 text-sm">Tools that work like you do.</p>
                    
                    <button class="btn-gradient-border text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 w-max transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 flex items-center gap-2 text-sm">
                        Explore Role
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </article>

            <!-- Card 2: Marketers -->
            <article class="tech-card snap-center shrink-0 w-[85vw] md:w-[380px] h-[480px] rounded-[2.5rem] overflow-hidden relative group bg-[#0a0a14] border border-white/5 hover:border-white/20 shadow-[0_15px_35px_rgba(0,0,0,0.8)] transition-all duration-500 pointer-events-none md:pointer-events-auto transform-gpu">
                <div class="absolute inset-[1px] rounded-[2.4rem] border border-white/0 group-hover:border-[#9d00ff]/30 pointer-events-none z-20 transition-colors duration-500"></div>
                
                <div class="absolute inset-0 z-0">
                    <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/marketers.webp" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-60 mix-blend-lighten transition-all duration-700 will-change-transform" alt="Marketers BG">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] via-[#0a0a14]/80 to-transparent"></div>
                </div>

                <div class="absolute top-6 left-6 flex items-center gap-2 z-20 opacity-50 group-hover:opacity-100 transition-opacity">
                    <span class="w-2 h-2 rounded-full bg-[#9d00ff] animate-pulse"></span>
                    <span class="text-xs font-mono text-white tracking-widest">ID_02</span>
                </div>
                <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-50 transition-opacity duration-500 delay-100 font-mono text-[10px] text-right text-white">
                    SYS.OP // OK<br>RDY_
                </div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="relative w-20 h-20 mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="absolute inset-0 rounded-2xl border border-white/20 group-hover:border-[#9d00ff] group-hover:shadow-[0_0_20px_rgba(157,0,255,0.4)] transition-all duration-500 z-10"></div>
                        <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/img-marketer.webp?w=480" class="w-full h-full rounded-2xl object-cover p-1 relative z-0" alt="Marketers">
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 tracking-tight">Marketers</h3>
                    <p class="text-gray-400 mb-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 text-sm">Create faster, explore new possibilities.</p>
                    
                    <button class="btn-gradient-border text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 w-max transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 flex items-center gap-2 text-sm">
                        Explore Role
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </article>

            <!-- Card 3: Web Developers -->
            <article class="tech-card snap-center shrink-0 w-[85vw] md:w-[380px] h-[480px] rounded-[2.5rem] overflow-hidden relative group bg-[#0a0a14] border border-white/5 hover:border-white/20 shadow-[0_15px_35px_rgba(0,0,0,0.8)] transition-all duration-500 pointer-events-none md:pointer-events-auto transform-gpu">
                <div class="absolute inset-[1px] rounded-[2.4rem] border border-white/0 group-hover:border-[#f9005b]/30 pointer-events-none z-20 transition-colors duration-500"></div>
                
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1669023414162-8b0573b9c6b2?q=80&w=2064&auto=format&fit=crop" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-60 mix-blend-lighten transition-all duration-700 will-change-transform" alt="Web Developers BG">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] via-[#0a0a14]/80 to-transparent"></div>
                </div>

                <div class="absolute top-6 left-6 flex items-center gap-2 z-20 opacity-50 group-hover:opacity-100 transition-opacity">
                    <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse"></span>
                    <span class="text-xs font-mono text-white tracking-widest">ID_03</span>
                </div>
                <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-50 transition-opacity duration-500 delay-100 font-mono text-[10px] text-right text-white">
                    SYS.OP // OK<br>RDY_
                </div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="relative w-20 h-20 mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="absolute inset-0 rounded-2xl border border-white/20 group-hover:border-[#f9005b] group-hover:shadow-[0_0_20px_rgba(249,0,91,0.4)] transition-all duration-500 z-10"></div>
                        <img src="https://images.unsplash.com/photo-1669023414171-56f0740e34cd?q=80&w=480&auto=format&fit=crop" class="w-full h-full rounded-2xl object-cover p-1 relative z-0" alt="Web Developers">
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 tracking-tight">Web Developers</h3>
                    <p class="text-gray-400 mb-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 text-sm">Build scalable, robust, and modern applications.</p>
                    
                    <button class="btn-gradient-border text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 w-max transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 flex items-center gap-2 text-sm">
                        Explore Role
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </article>

            <!-- Card 4: Content creators -->
            <article class="tech-card snap-center shrink-0 w-[85vw] md:w-[380px] h-[480px] rounded-[2.5rem] overflow-hidden relative group bg-[#0a0a14] border border-white/5 hover:border-white/20 shadow-[0_15px_35px_rgba(0,0,0,0.8)] transition-all duration-500 pointer-events-none md:pointer-events-auto transform-gpu">
                <div class="absolute inset-[1px] rounded-[2.4rem] border border-white/0 group-hover:border-[#9d00ff]/30 pointer-events-none z-20 transition-colors duration-500"></div>
                
                <div class="absolute inset-0 z-0">
                    <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/content-creators.webp" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-60 mix-blend-lighten transition-all duration-700 will-change-transform" alt="Content Creators BG">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] via-[#0a0a14]/80 to-transparent"></div>
                </div>

                <div class="absolute top-6 left-6 flex items-center gap-2 z-20 opacity-50 group-hover:opacity-100 transition-opacity">
                    <span class="w-2 h-2 rounded-full bg-[#9d00ff] animate-pulse"></span>
                    <span class="text-xs font-mono text-white tracking-widest">ID_04</span>
                </div>
                <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-50 transition-opacity duration-500 delay-100 font-mono text-[10px] text-right text-white">
                    SYS.OP // OK<br>RDY_
                </div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="relative w-20 h-20 mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="absolute inset-0 rounded-2xl border border-white/20 group-hover:border-[#9d00ff] group-hover:shadow-[0_0_20px_rgba(157,0,255,0.4)] transition-all duration-500 z-10"></div>
                        <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/img-content.webp?w=480" class="w-full h-full rounded-2xl object-cover p-1 relative z-0" alt="Content creators">
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 tracking-tight">Content creators</h3>
                    <p class="text-gray-400 mb-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 text-sm">Make scroll-stopping content, easily.</p>
                    <button class="btn-gradient-border text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 w-max transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 flex items-center gap-2 text-sm">
                        Explore Role
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </article>

            <!-- Card 5: Art directors -->
            <article class="tech-card snap-center shrink-0 w-[85vw] md:w-[380px] h-[480px] rounded-[2.5rem] overflow-hidden relative group bg-[#0a0a14] border border-white/5 hover:border-white/20 shadow-[0_15px_35px_rgba(0,0,0,0.8)] transition-all duration-500 pointer-events-none md:pointer-events-auto transform-gpu">
                <div class="absolute inset-[1px] rounded-[2.4rem] border border-white/0 group-hover:border-[#f9005b]/30 pointer-events-none z-20 transition-colors duration-500"></div>
                
                <div class="absolute inset-0 z-0">
                    <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/art-directors.webp" class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-60 mix-blend-lighten transition-all duration-700 will-change-transform" alt="Art Directors BG">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14] via-[#0a0a14]/80 to-transparent"></div>
                </div>

                <div class="absolute top-6 left-6 flex items-center gap-2 z-20 opacity-50 group-hover:opacity-100 transition-opacity">
                    <span class="w-2 h-2 rounded-full bg-[#f9005b] animate-pulse"></span>
                    <span class="text-xs font-mono text-white tracking-widest">ID_05</span>
                </div>
                <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-50 transition-opacity duration-500 delay-100 font-mono text-[10px] text-right text-white">
                    SYS.OP // OK<br>RDY_
                </div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="relative w-20 h-20 mb-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="absolute inset-0 rounded-2xl border border-white/20 group-hover:border-[#f9005b] group-hover:shadow-[0_0_20px_rgba(249,0,91,0.4)] transition-all duration-500 z-10"></div>
                        <img src="https://cdn-front.freepik.com/home/anon-rvmp/professionals/img-art.webp?w=480" class="w-full h-full rounded-2xl object-cover p-1 relative z-0" alt="Art directors">
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 tracking-tight">Art directors</h3>
                    <p class="text-gray-400 mb-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 text-sm">Creative control at every stage.</p>
                    <button class="btn-gradient-border text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 w-max transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 flex items-center gap-2 text-sm">
                        Explore Role
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </article>

        </div>
    </div>
</section>

<!-- Section 3: Portaplane 3D Interaction -->
<section id="section-portaplane" class="relative w-full h-[95vh] bg-black flex items-center justify-center overflow-hidden z-30">
    <div id="portaplane-canvas-wrapper" class="absolute inset-0 w-full h-full block">
        
        <div class="portaplane-instructions absolute bottom-28 left-1/2 transform -translate-x-1/2 z-[100] text-center text-white px-6 py-4 rounded-lg w-4/5 max-w-3xl pointer-events-none">
            <h2 class="text-3xl md:text-5xl mb-4 text-[#f9005b] drop-shadow-md" style="font-family: 'Lobster', cursive;">Innovative 3D Interaction</h2>
            <p class="text-sm md:text-base text-gray-300 bg-black/40 inline-block px-4 py-2 rounded-full backdrop-blur-sm border border-white/10">You can move this image very smoothly. Select 'Mouse Move' for your desktop and 'Gyroscope' for mobile.</p>
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

<!-- Section 4: Kinetic Typography (Branding Statement) -->
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
            <span class="kinetic-word text-outline">Design.</span>
            <span class="kinetic-word text-outline">Design.</span>
            <span class="kinetic-word text-outline">Design.</span>
            <span class="kinetic-word text-outline">Design.</span>
            <span class="kinetic-word text-outline">Design.</span>
        </div>
        
        <div class="kinetic-row marquee-left flex items-center gap-6 md:gap-12 text-6xl md:text-8xl lg:text-[10rem] font-black uppercase tracking-tighter w-max will-change-transform" style="transform: translateX(-5%);">
            <span class="kinetic-word text-outline">Disrupt.</span>
            <span class="kinetic-word text-outline">Disrupt.</span>
            <span class="kinetic-word text-outline">Disrupt.</span>
            <span class="kinetic-word text-outline">Disrupt.</span>
            <span class="kinetic-word text-outline">Disrupt.</span>
        </div>
    </div>
</section>

<!-- Section 5: The Glitch / Break The Rules -->
<section id="glitch-section" class="relative w-full h-screen bg-white flex items-center justify-center overflow-hidden z-30">
    <!-- State 1: Boring Agency -->
    <div id="boring-state" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-100 z-20 will-change-transform">
        <h2 class="text-3xl md:text-5xl font-sans text-gray-400 font-light mb-4">We are a standard digital agency.</h2>
        <p class="text-gray-400 font-sans">We build websites and do marketing stuff.</p>
    </div>
    
    <!-- State 2: Chaos / Disrupt -->
    <div id="chaos-state" class="absolute inset-0 flex flex-col items-center justify-center bg-black z-10 opacity-0 transform scale-110 will-change-transform">
        <div class="glitch-wrapper">
            <h2 class="glitch-text text-5xl md:text-8xl lg:text-9xl text-center" data-text="WE BREAK THE RULES">WE BREAK THE RULES</h2>
        </div>
        <p class="text-[#f9005b] mt-6 text-xl md:text-2xl font-mono tracking-widest uppercase animate-pulse">Standard is dead.</p>
    </div>
</section>


<!-- Section 5.5a: Text Mobile untuk Scary Face (Hanya tampil di HP) -->
<section class="md:hidden pt-20 pb-10 px-6 bg-black relative z-30 flex flex-col justify-center">
    <p class="text-[#f9005b] font-mono text-xs tracking-widest uppercase mb-3 animate-pulse">/// SYSTEM OVERRIDE ///</p>
    <h3 class="text-5xl font-black text-white uppercase tracking-tighter leading-none mb-6" style="font-family: 'Impact', sans-serif;">
        Oh, We Also Do<br>
        <span class="text-transparent" style="-webkit-text-stroke: 2px #f9005b;">3D MODELING</span>
    </h3>
    <p class="font-sans text-gray-300 text-sm bg-[#0a0a14]/60 p-5 rounded-2xl border border-white/10 backdrop-blur-md shadow-[0_10px_30px_rgba(249,0,91,0.1)] leading-relaxed">
        Membangun pengalaman WebGL interaktif dan aset 3D kustom. Karena desain website datar biasa sudah terlalu membosankan untuk mengeksekusi ide liar Anda.
    </p>
</section>

<!-- Section 5.5b: Scary Face Demonstration (Eksperimen Chaos Baru) -->
<section id="scary-section" class="relative w-full h-[60vh] md:h-screen bg-black flex items-center justify-center overflow-hidden z-30 border-t md:border-t-0 border-white/5">
    <div id="scene-container"></div>
    
    <!-- Overlay Informasi 3D Modeling (Hanya tampil di Desktop) -->
    <div class="hidden md:block absolute top-12 left-6 md:top-24 md:left-24 z-20 pointer-events-none">
        <p class="text-[#f9005b] font-mono text-xs md:text-sm tracking-widest uppercase mb-3 animate-pulse">/// SYSTEM OVERRIDE ///</p>
        <h3 class="text-5xl md:text-7xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none" style="font-family: 'Impact', sans-serif;">
            Oh, We Also Do<br>
            <span class="text-transparent" style="-webkit-text-stroke: 2px #f9005b;">3D MODELING</span>
        </h3>
        <p class="mt-6 font-sans text-gray-300 text-sm md:text-base max-w-md bg-[#0a0a14]/60 p-5 rounded-2xl border border-white/10 backdrop-blur-md shadow-[0_10px_30px_rgba(249,0,91,0.1)]">
            Membangun pengalaman WebGL interaktif dan aset 3D kustom. Karena desain website datar biasa sudah terlalu membosankan untuk mengeksekusi ide liar Anda.
        </p>
    </div>

    <!-- Instruksi Interaksi -->
    <div class="absolute bottom-6 md:bottom-10 left-6 md:left-24 z-10 text-xs md:text-sm text-gray-300 font-mono pointer-events-none bg-[#0a0a14]/80 px-5 py-3 rounded-full border border-white/10 flex items-center gap-3 backdrop-blur-md shadow-lg">
        <span class="w-2.5 h-2.5 rounded-full bg-[#f9005b] animate-ping relative"><span class="absolute inset-0 bg-[#f9005b] rounded-full"></span></span>
        <span class="md:hidden">[ INTERACT ] Touch & drag</span>
        <span class="hidden md:inline">[ INTERACT ] Move your mouse around... and wait for it.</span>
    </div>
</section>


<!-- Section 5.8: Lab City 3D (Eksperimen Tambahan) -->
<section id="city-section" class="relative w-full h-screen bg-[#F02050] overflow-hidden z-30 disable-selection">
    <div id="city-canvas-wrapper" class="absolute inset-0 w-full h-full block"></div>
    
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 pointer-events-none text-center w-full px-4">
        <h2 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter mb-2 drop-shadow-lg" style="font-family: 'Impact', sans-serif;">
            Lab City 3D
            <sup class="text-xs bg-black/60 text-white px-2 py-1 rounded-sm ml-2 font-mono tracking-normal relative -top-6 md:-top-10">Three.js</sup>
        </h2>
        <!-- BAGIAN YANG DIUBAH -->
        <p class="text-white/90 tracking-widest uppercase font-mono text-sm md:text-lg drop-shadow-md font-bold mt-4">
            — WE BUILD DIGITAL DIMENSIONS —
        </p>
        <p class="text-white/70 font-sans text-xs md:text-sm max-w-lg mx-auto mt-2">
            Dari animasi 3D sinematik hingga dunia WebGL interaktif. Kami mengubah imajinasi liar Anda menjadi realitas digital yang bisa disentuh.
        </p>
        <!-- AKHIR BAGIAN YANG DIUBAH -->
    </div>
</section>

<!-- Section 6: The Lab (Selected Works / Portfolio) -->
<section id="lab-section" class="py-32 bg-[#05050a] relative z-30 border-t border-white/5">
    <!-- Decorative Background -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[80%] h-32 bg-[#9d00ff]/20 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
        <div class="text-center mb-20">
            <h2 class="text-5xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff] mb-6 tracking-tighter uppercase" style="font-family: 'Impact', sans-serif;">The Lab</h2>
            <p class="text-gray-300 text-lg md:text-xl uppercase tracking-widest font-mono">We don't just experiment. We deliver.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Project 1 -->
            <div class="group relative overflow-hidden rounded-[2rem] border border-white/10 bg-[#0a0a14] aspect-[4/3] cursor-pointer shadow-2xl">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-80 transition-all duration-700" alt="Data Visualization Project">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                
                <div class="absolute top-6 left-6 flex gap-2">
                    <span class="bg-[#f9005b]/20 text-[#f9005b] border border-[#f9005b]/30 px-3 py-1 rounded-full text-xs font-mono font-bold backdrop-blur-md">WEB APP</span>
                    <span class="bg-white/10 text-white border border-white/20 px-3 py-1 rounded-full text-xs font-mono font-bold backdrop-blur-md">UI/UX</span>
                </div>

                <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <h3 class="text-3xl font-bold text-white mb-3 tracking-tight">FinTech Dashboard</h3>
                    <p class="text-gray-400 text-sm max-w-md opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">Mentransformasi data kompleks menjadi antarmuka visual yang intuitif dan memukau.</p>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="group relative overflow-hidden rounded-[2rem] border border-white/10 bg-[#0a0a14] aspect-[4/3] cursor-pointer shadow-2xl md:translate-y-12">
                <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-80 transition-all duration-700" alt="E-Commerce Project">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                
                <div class="absolute top-6 left-6 flex gap-2">
                    <span class="bg-[#9d00ff]/20 text-[#9d00ff] border border-[#9d00ff]/30 px-3 py-1 rounded-full text-xs font-mono font-bold backdrop-blur-md">E-COMMERCE</span>
                    <span class="bg-white/10 text-white border border-white/20 px-3 py-1 rounded-full text-xs font-mono font-bold backdrop-blur-md">3D WEB</span>
                </div>

                <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <h3 class="text-3xl font-bold text-white mb-3 tracking-tight">NeonWave Store</h3>
                    <p class="text-gray-400 text-sm max-w-md opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">Pengalaman belanja digital imersif dengan integrasi WebGL dan elemen 3D interaktif.</p>
                </div>
            </div>
        </div>

        <div class="mt-24 text-center">
            <button class="inline-flex items-center gap-3 text-white border border-white/20 px-8 py-4 rounded-full font-bold hover:bg-white hover:text-black transition-all duration-300">
                Lihat Semua Karya
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </button>
        </div>
    </div>
</section>

<!-- Section 7: The Vibe Configurator -->
<section id="vibe-section" class="py-32 relative transition-all duration-700 flex flex-col items-center justify-center z-30" style="background-color: #f8f9fa; color: #333333;">
    <h2 id="vibe-title" class="text-3xl md:text-5xl font-bold mb-12 transition-all duration-500 text-center px-4" style="font-family: sans-serif;">We offer standard services.</h2>
    
    <div class="w-full max-w-3xl px-6 flex flex-col items-center">
        <!-- Range Slider -->
        <input type="range" id="vibe-slider" min="0" max="100" value="0" class="w-full h-4 bg-gray-300 rounded-lg appearance-none cursor-pointer mb-6 relative z-10">
        
        <!-- Label Slider -->
        <div class="flex justify-between w-full text-xs md:text-sm font-bold uppercase tracking-widest text-inherit opacity-70">
            <span>Safe</span>
            <span>Modern</span>
            <span>Disrupt</span>
        </div>
    </div>
</section>

<!-- Call To Action (CTA) Section -->
<section id="kontak" class="py-20 relative z-30 overflow-hidden transition-all duration-700" style="background-color: #1a1a2e;">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
        <div id="cta-card" class="bg-gradient-to-br from-[#f9005b] to-[#9d00ff] rounded-3xl p-10 md:p-16 text-center shadow-[0_0_40px_rgba(249,0,91,0.3)] relative overflow-hidden backdrop-blur-sm border border-white/10 transition-all duration-500 will-change-transform">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
            
            <h2 id="cta-heading" class="text-3xl md:text-5xl font-normal text-white mb-6 relative z-10" style="font-family: 'Lobster', cursive;">Siap Mewujudkan Ide Digital Anda?</h2>
            <p id="cta-desc" class="text-white/80 mb-10 text-lg max-w-2xl mx-auto relative z-10">Hubungi tim ahli kami sekarang untuk mendapatkan konsultasi gratis mengenai kebutuhan digital dan skalabilitas bisnis Anda.</p>
            
            <a href="mailto:rizkialiakhbar@gmail.com" id="vibe-btn" class="inline-block bg-[#080815] text-white font-bold px-10 py-4 rounded-xl shadow-lg hover:bg-black transition-all hover:-translate-y-1 relative z-10 border border-white/10">
                Konsultasi Gratis Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Section 8: Our Clients (Marquee Paling Terakhir) -->
<section id="clients-section" class="py-20 bg-[#080815] relative z-30 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 relative z-10 mb-12">
        <div class="text-center">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 drop-shadow-lg" style="font-family: 'Impact', sans-serif;">Our Clients</h2>
            <p class="text-gray-400 font-mono text-sm md:text-base tracking-widest uppercase">Dipercaya oleh ekosistem digital terkemuka</p>
        </div>
    </div>

    <!-- Area Marquee Infinite Scroll -->
    <div class="marquee-wrapper w-full py-8">
        <div class="marquee-content gap-16 md:gap-32 px-16">
            <!-- Set 1 -->
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>
            
            <!-- Set 2 -->
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>

            <!-- Set 3 -->
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest">NEXUS.</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-bold text-white uppercase font-serif italic">Aether</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase font-mono tracking-tighter">CYBER<span class="text-[#f9005b]">DYNE</span></h3>
            <h3 class="client-brand text-4xl md:text-6xl font-normal text-white" style="font-family: 'Lobster', cursive;">Lumina</h3>
            <h3 class="client-brand text-3xl md:text-5xl font-black text-white uppercase tracking-widest border-4 border-white px-6 py-2">OBELISK</h3>

            <!-- Set 4 -->
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

<!-- Script Keseluruhan (Script GSAP Utama + Portaplane + City 3D) dipindah ke file terpisah -->
<script src="{{ asset('js/home-main.js') }}"></script>

<!-- Import Map Baru Khusus Untuk Scary Scene (Three.js Modern) -->
<script type="importmap">
    {
        "imports": {
            "three": "https://cdn.jsdelivr.net/npm/three@0.164/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.164/examples/jsm/"
    }
}
</script>

<script type="module" src="{{ asset('js/home-scary.js') }}"></script>
@endsection