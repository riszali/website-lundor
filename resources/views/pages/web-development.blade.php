@extends('layouts.main')

@section('title', 'Web Development - Lund\'or Imagine Digital')

@section('content')
<!-- Font Khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Memanggil CSS Eksternal -->
<link rel="stylesheet" href="{{ asset('css/web-development.css') }}">

<!-- HERO SECTION DENGAN 3D ROOM -->
<section class="relative w-full min-h-screen bg-[#080815] flex items-center justify-center overflow-hidden bg-grid-pattern pt-20">
    <!-- Ornamen Glow Background -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#f9005b] rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-[#9d00ff] rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

    <div class="max-w-[90rem] mx-auto px-6 relative z-10 w-full flex flex-col lg:flex-row items-center justify-between gap-12">
        
        <!-- Bagian Teks Kiri -->
        <div class="flex flex-col items-start w-full lg:w-1/2">
            <div class="gsap-reveal overflow-hidden mb-4">
                <span class="inline-block text-[#f9005b] font-mono tracking-widest uppercase text-sm border border-[#f9005b]/30 bg-[#f9005b]/10 px-4 py-1.5 rounded-full">
                    // Division_03: Engineering
                </span>
            </div>
            
            <h1 class="font-space text-6xl md:text-8xl lg:text-9xl font-black text-white leading-none tracking-tighter uppercase mb-6">
                <div class="gsap-reveal overflow-hidden"><span class="inline-block">We Build</span></div>
                <div class="gsap-reveal overflow-hidden"><span class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Digital</span></div>
                <div class="gsap-reveal overflow-hidden"><span class="inline-block">Realities.</span></div>
            </h1>
            
            <div class="gsap-reveal overflow-hidden max-w-2xl">
                <p class="text-gray-400 text-lg md:text-xl font-light">
                    Website biasa sudah mati. Kami membangun ekosistem web berkinerja tinggi, interaktif, dan *scalable* yang memaksa audiens Anda untuk berhenti *scrolling* dan mulai berinteraksi.
                </p>
            </div>
        </div>

        <!-- Bagian 3D Room CSS Kanan -->
        <div class="w-full lg:w-1/2 relative h-[50vh] lg:h-[70vh] flex items-center justify-center room-3d-wrapper z-10 pointer-events-none md:pointer-events-auto">
            <div class="house" id="h"> 
                <div class="h-lights">
                    <div class="h-light"></div><div class="h-light"></div><div class="h-light"></div>
                    <div class="h-light"></div><div class="h-light"></div><div class="h-light"></div>
                </div>
                <div class="h-shadow"></div>
                <div class="alt">
                    <div class="alt__front face"> </div><div class="alt__back face"> </div><div class="alt__right face"> </div>
                    <div class="alt__left face"> </div>
                    <div class="alt__top face"> 
                        <div class="light"></div><div class="light"></div><div class="light"></div>
                        <div class="light"></div><div class="light"></div><div class="light"></div>
                        <div class="light"></div><div class="light"></div><div class="light"></div>
                    </div>
                    <div class="alt__bottom face"> </div>
                </div>
                <div class="alb">
                    <div class="alb__front face"> </div><div class="alb__back face"> </div><div class="alb__right face"> </div>
                    <div class="alb__left face"> </div><div class="alb__top face"> </div><div class="alb__bottom face"> </div>
                </div>
                <div class="arb">
                    <div class="arb__front face"> </div><div class="arb__back face"> </div><div class="arb__right face"> </div>
                    <div class="arb__left face"> </div><div class="arb__top face"> </div><div class="arb__bottom face"> </div>
                </div>
                <div class="blt">
                    <div class="blt__front face"> </div><div class="blt__back face"> </div><div class="blt__right face"> </div>
                    <div class="blt__left face"> </div><div class="blt__top face"> </div><div class="blt__bottom face"> </div>
                </div>
                <div class="blt2">
                    <div class="blt2__front face"> </div><div class="blt2__back face"> </div><div class="blt2__right face"> </div>
                    <div class="blt2__left face"> </div><div class="blt2__top face"> </div><div class="blt2__bottom face"> </div>
                </div>
                <div class="blb">
                    <div class="blb__front face"> </div><div class="blb__back face"> </div><div class="blb__right face"> </div>
                    <div class="blb__left face"> </div><div class="blb__top face"> </div><div class="blb__bottom face"> </div>
                </div>
                <div class="blb2">
                    <div class="blb2__front face"> </div><div class="blb2__back face"> </div><div class="blb2__right face"> </div>
                    <div class="blb2__left face"> </div><div class="blb2__top face"> </div><div class="blb2__bottom face"> </div>
                </div>
                <div class="puerta-c">
                    <div class="puerta">
                    <div class="puerta__front face"> </div><div class="puerta__back face"> </div><div class="puerta__right face"> </div>
                    <div class="puerta__left face"> </div><div class="puerta__top face"> </div><div class="puerta__bottom face"> </div>
                    </div>
                    <div class="puerta-l">
                    <div class="puerta-l__front face"> </div><div class="puerta-l__back face"> </div><div class="puerta-l__right face"> </div>
                    <div class="puerta-l__left face"> </div><div class="puerta-l__top face"> </div><div class="puerta-l__bottom face"> </div>
                    </div>
                    <div class="puerta-r">
                    <div class="puerta-r__front face"> </div><div class="puerta-r__back face"> </div><div class="puerta-r__right face"> </div>
                    <div class="puerta-r__left face"> </div><div class="puerta-r__top face"> </div><div class="puerta-r__bottom face"> </div>
                    </div>
                    <div class="puerta-t">
                    <div class="puerta-t__front face"> </div><div class="puerta-t__back face"> </div><div class="puerta-t__right face"> </div>
                    <div class="puerta-t__left face"> </div><div class="puerta-t__top face"> </div><div class="puerta-t__bottom face"> </div>
                    </div>
                </div>
                <div class="cuadro-l">
                    <div class="cuadro-l__front face"> </div><div class="cuadro-l__back face"> </div><div class="cuadro-l__right face"> </div>
                    <div class="cuadro-l__left face"> </div><div class="cuadro-l__top face"> </div><div class="cuadro-l__bottom face"> </div>
                </div>
                <div class="cuadro-r">
                    <div class="cuadro-r__front face"> </div><div class="cuadro-r__back face"> </div><div class="cuadro-r__right face"> </div>
                    <div class="cuadro-r__left face"> </div><div class="cuadro-r__top face"> </div><div class="cuadro-r__bottom face"> </div>
                </div>
                <div class="librero">
                    <div class="librero__front face"> </div><div class="librero__back face"> </div><div class="librero__right face"> </div>
                    <div class="librero__left face"> </div><div class="librero__top face"> </div><div class="librero__bottom face"> </div>
                </div>
                <div class="libros"> 
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                    <div class="libro"><div class="libro__front face"> </div><div class="libro__back face"> </div><div class="libro__right face"> </div><div class="libro__left face"> </div><div class="libro__top face"> </div><div class="libro__bottom face"> </div></div>
                </div>
                <div class="fotos"> 
                    <div class="foto"><div class="foto__front face"> </div><div class="foto__back face"> </div><div class="foto__right face"> </div><div class="foto__left face"> </div><div class="foto__top face"> </div><div class="foto__bottom face"> </div></div>
                    <div class="foto"><div class="foto__front face"> </div><div class="foto__back face"> </div><div class="foto__right face"> </div><div class="foto__left face"> </div><div class="foto__top face"> </div><div class="foto__bottom face"> </div></div>
                </div>
                <div class="cajas"> 
                    <div class="caja"><div class="caja__front face"> </div><div class="caja__back face"> </div><div class="caja__right face"> </div><div class="caja__left face"> </div><div class="caja__top face"> </div><div class="caja__bottom face"> </div></div>
                    <div class="caja"><div class="caja__front face"> </div><div class="caja__back face"> </div><div class="caja__right face"> </div><div class="caja__left face"> </div><div class="caja__top face"> </div><div class="caja__bottom face"> </div></div>
                    <div class="caja"><div class="caja__front face"> </div><div class="caja__back face"> </div><div class="caja__right face"> </div><div class="caja__left face"> </div><div class="caja__top face"> </div><div class="caja__bottom face"> </div></div>
                </div>
                <div class="tv">
                    <div class="tv__front face"> </div><div class="tv__back face"> </div><div class="tv__right face"> </div>
                    <div class="tv__left face"> </div><div class="tv__top face"> </div><div class="tv__bottom face"> </div>
                </div>
                <div class="repisa-t">
                    <div class="repisa-t__front face"> </div><div class="repisa-t__back face"> </div><div class="repisa-t__right face"> </div>
                    <div class="repisa-t__left face"> </div><div class="repisa-t__top face"> </div><div class="repisa-t__bottom face"> </div>
                </div>
                <div class="repisa-b">
                    <div class="repisa-b__front face"> </div><div class="repisa-b__back face"> </div><div class="repisa-b__right face"> </div>
                    <div class="repisa-b__left face"> </div><div class="repisa-b__top face"> </div><div class="repisa-b__bottom face"> </div>
                </div>
                <div class="bocina-l">
                    <div class="bocina-l__front face"> </div><div class="bocina-l__back face"> </div><div class="bocina-l__right face"> </div>
                    <div class="bocina-l__left face"> </div><div class="bocina-l__top face"> </div><div class="bocina-l__bottom face"> </div>
                </div>
                <div class="bocina-r">
                    <div class="bocina-r__front face"> </div><div class="bocina-r__back face"> </div><div class="bocina-r__right face"> </div>
                    <div class="bocina-r__left face"> </div><div class="bocina-r__top face"> </div><div class="bocina-r__bottom face"> </div>
                </div>
                <div class="muro">
                    <div class="muro__front face"> </div><div class="muro__back face"> </div><div class="muro__right face"> </div>
                    <div class="muro__left face"> </div><div class="muro__top face"> </div><div class="muro__bottom face"> </div>
                </div>
                <div class="sillon-c">
                    <div class="sillon-b"><div class="sillon-b__front face"> </div><div class="sillon-b__back face"> </div><div class="sillon-b__right face"> </div><div class="sillon-b__left face"> </div><div class="sillon-b__top face"> </div><div class="sillon-b__bottom face"> </div></div>
                    <div class="sillon-t"><div class="sillon-t__front face"> </div><div class="sillon-t__back face"> </div><div class="sillon-t__right face"> </div><div class="sillon-t__left face"> </div><div class="sillon-t__top face"> </div><div class="sillon-t__bottom face"> </div></div>
                    <div class="sillon-l"><div class="sillon-l__front face"> </div><div class="sillon-l__back face"> </div><div class="sillon-l__right face"> </div><div class="sillon-l__left face"> </div><div class="sillon-l__top face"> </div><div class="sillon-l__bottom face"> </div></div>
                    <div class="sillon-r"><div class="sillon-r__front face"> </div><div class="sillon-r__back face"> </div><div class="sillon-r__right face"> </div><div class="sillon-r__left face"> </div><div class="sillon-r__top face"> </div><div class="sillon-r__bottom face"> </div></div>
                </div>
                <div class="mesa-c">
                    <div class="mesa"><div class="mesa__front face"> </div><div class="mesa__back face"> </div><div class="mesa__right face"> </div><div class="mesa__left face"> </div><div class="mesa__top face"> </div><div class="mesa__bottom face"> </div></div>
                    <div class="mesa-p"><div class="mesa-p__front face"> </div><div class="mesa-p__back face"> </div><div class="mesa-p__right face"> </div><div class="mesa-p__left face"> </div><div class="mesa-p__top face"> </div><div class="mesa-p__bottom face"> </div></div>
                    <div class="mesa-p"><div class="mesa-p__front face"> </div><div class="mesa-p__back face"> </div><div class="mesa-p__right face"> </div><div class="mesa-p__left face"> </div><div class="mesa-p__top face"> </div><div class="mesa-p__bottom face"> </div></div>
                    <div class="mesa-p"><div class="mesa-p__front face"> </div><div class="mesa-p__back face"> </div><div class="mesa-p__right face"> </div><div class="mesa-p__left face"> </div><div class="mesa-p__top face"> </div><div class="mesa-p__bottom face"> </div></div>
                    <div class="mesa-p"><div class="mesa-p__front face"> </div><div class="mesa-p__back face"> </div><div class="mesa-p__right face"> </div><div class="mesa-p__left face"> </div><div class="mesa-p__top face"> </div><div class="mesa-p__bottom face"> </div></div>
                    <div class="mesa-shadow"></div>
                </div>
                <div class="tablet">
                    <div class="tablet__front face"> </div><div class="tablet__back face"> </div><div class="tablet__right face"> </div>
                    <div class="tablet__left face"> </div><div class="tablet__top face"> </div><div class="tablet__bottom face"> </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- THE PHILOSOPHY SECTION -->
<section class="py-32 bg-[#05050a] relative border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="gsap-fade-up">
                <h2 class="text-4xl md:text-6xl font-black text-white mb-6 uppercase tracking-tight font-space">Code is our <br><span class="text-[#f9005b]">Canvas</span></h2>
                <p class="text-gray-400 text-lg mb-6">
                    Bagi kami, pengembangan web bukan sekadar merangkai kode agar sebuah halaman bisa dibuka. Ini adalah tentang arsitektur.
                </p>
                <p class="text-gray-400 text-lg mb-8">
                    Dari *landing page* super cepat berbasis statis, platform E-Commerce yang kompleks, hingga pengalaman WebGL/3D yang membuat *browser* terasa seperti *game engine*. Kami mengkombinasikan estetika desain gila dengan kode yang bersih dan terstruktur.
                </p>
                <div class="flex gap-4">
                    <div class="w-16 h-1 bg-gradient-to-r from-[#f9005b] to-transparent"></div>
                    <div class="w-16 h-1 bg-gradient-to-r from-[#9d00ff] to-transparent"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-6">
                <!-- Service Cards -->
                <div class="gsap-fade-up bg-[#0a0a14] border border-white/10 p-8 rounded-3xl hover:border-[#f9005b]/50 transition-colors group">
                    <h3 class="text-2xl font-bold text-white mb-3 flex items-center gap-4">
                        <span class="text-[#f9005b] font-mono text-sm">01</span> WebGL & 3D Experiences
                    </h3>
                    <p class="text-gray-500 text-sm">Mengubah website datar menjadi dunia interaktif menggunakan Three.js dan shaders kustom. Sempurna untuk *product showcase* premium.</p>
                </div>
                
                <div class="gsap-fade-up bg-[#0a0a14] border border-white/10 p-8 rounded-3xl hover:border-[#9d00ff]/50 transition-colors group" style="transition-delay: 0.1s;">
                    <h3 class="text-2xl font-bold text-white mb-3 flex items-center gap-4">
                        <span class="text-[#9d00ff] font-mono text-sm">02</span> High-Performance Web Apps
                    </h3>
                    <p class="text-gray-500 text-sm">Aplikasi web skala perusahaan (PWA/SPA) menggunakan React, Vue, atau Laravel yang merespon secepat kedipan mata.</p>
                </div>

                <div class="gsap-fade-up bg-[#0a0a14] border border-white/10 p-8 rounded-3xl hover:border-white/50 transition-colors group" style="transition-delay: 0.2s;">
                    <h3 class="text-2xl font-bold text-white mb-3 flex items-center gap-4">
                        <span class="text-white font-mono text-sm">03</span> Headless E-Commerce
                    </h3>
                    <p class="text-gray-500 text-sm">Arsitektur modern untuk toko online. Memisahkan *frontend* dan *backend* untuk kecepatan brutal dan kustomisasi tanpa batas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TECH STACK MARQUEE -->
<section class="py-20 bg-[#f9005b] overflow-hidden transform -skew-y-2 relative z-20">
    <div class="transform skew-y-2">
        <h2 class="text-center text-black font-black uppercase tracking-widest mb-10 text-xl md:text-2xl">Our Weapons of Choice</h2>
        
        <div class="marquee-container gap-8 px-4 text-4xl md:text-6xl font-black text-black/80 uppercase tracking-tighter font-space">
            <span>React.JS</span>
            <span>•</span>
            <span>Three.JS</span>
            <span>•</span>
            <span>Laravel</span>
            <span>•</span>
            <span>GSAP</span>
            <span>•</span>
            <span>Tailwind</span>
            <span>•</span>
            <span>Node.JS</span>
            <span>•</span>
            <span>Vue.JS</span>
            <span>•</span>
            <!-- Duplicate for infinite loop -->
            <span>React.JS</span>
            <span>•</span>
            <span>Three.JS</span>
            <span>•</span>
            <span>Laravel</span>
            <span>•</span>
            <span>GSAP</span>
            <span>•</span>
            <span>Tailwind</span>
            <span>•</span>
            <span>Node.JS</span>
            <span>•</span>
            <span>Vue.JS</span>
            <span>•</span>
        </div>
    </div>
</section>

<!-- LIVE PORTFOLIO SECTION -->
<section class="py-32 bg-[#05050a] relative border-t border-white/5">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#f9005b]/5 via-[#05050a] to-[#05050a] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <!-- Header Section -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-6xl font-black text-white mb-6 uppercase tracking-tight font-space">
                Crafted With <span class="text-[#f9005b]">Purpose</span>
            </h2>
            <p class="text-gray-400 text-lg md:text-xl font-light font-sans tracking-wide">
                Every project we create is driven by clear goals and thoughtful execution. Explore how we turn ideas into meaningful results.
            </p>
        </div>

        <!-- Grid Portfolio Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Project 1: Geely Fatmawati -->
            <div class="portfolio-card relative rounded-3xl overflow-hidden border border-white/10 bg-[#0a0a14] group shadow-2xl">
                <!-- Label Kiri Atas -->
                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="px-4 py-1.5 text-xs font-bold font-mono bg-[#f9005b]/20 text-[#f9005b] backdrop-blur-md rounded-full border border-[#f9005b]/30">GEELY FATMAWATI</span>
                </div>
                
                <!-- Container dengan Aspek Rasio (16:9) -->
                <div class="relative w-full pt-[56.25%] bg-[#080815] overflow-hidden">
                    
                    <!-- Cover Image -->
                    <img src="{{ asset('assets/images/2026-03-18 210733.png') }}" alt="Geely Fatmawati Cover" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 group-hover:opacity-40 transition-all duration-700 ease-in-out z-0">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14]/60 via-transparent to-transparent z-0 pointer-events-none"></div>

                    <!-- Tombol di Tengah -->
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center transition-opacity duration-500">
                        <button class="load-iframe-btn flex items-center gap-3 bg-black/50 backdrop-blur-md border border-[#f9005b] text-[#f9005b] px-8 py-3.5 rounded-full font-bold hover:bg-[#f9005b] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(249,0,91,0.2)] hover:shadow-[0_0_30px_rgba(249,0,91,0.6)] cursor-pointer" data-url="https://geelyfatmawati.id">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Launch Experience
                        </button>
                    </div>
                    
                    <!-- Container Iframe -->
                    <div class="iframe-container absolute inset-0 opacity-0 transition-opacity duration-700">
                        <div class="absolute inset-0 z-10 pointer-events-none shadow-[inset_0_0_20px_rgba(0,0,0,0.5)]"></div>
                        <iframe src="about:blank" class="w-full h-full border-none custom-scrollbar" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Project 2: Geely BSD -->
            <div class="portfolio-card relative rounded-3xl overflow-hidden border border-white/10 bg-[#0a0a14] group shadow-2xl md:translate-y-12">
                <!-- Label Kiri Atas -->
                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="px-4 py-1.5 text-xs font-bold font-mono bg-[#9d00ff]/20 text-[#9d00ff] backdrop-blur-md rounded-full border border-[#9d00ff]/30">GEELY BSD</span>
                </div>
                
                <!-- Container dengan Aspek Rasio (16:9) -->
                <div class="relative w-full pt-[56.25%] bg-[#080815] overflow-hidden">
                    
                    <!-- Cover Image -->
                    <img src="{{ asset('assets/images/2026-03-18 211448.png') }}" alt="Geely BSD Cover" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 group-hover:opacity-40 transition-all duration-700 ease-in-out z-0">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a14]/60 via-transparent to-transparent z-0 pointer-events-none"></div>

                    <!-- Tombol di Tengah -->
                    <div class="preview-overlay absolute inset-0 z-10 flex flex-col items-center justify-center transition-opacity duration-500">
                        <button class="load-iframe-btn flex items-center gap-3 bg-black/50 backdrop-blur-md border border-[#9d00ff] text-[#9d00ff] px-8 py-3.5 rounded-full font-bold hover:bg-[#9d00ff] hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(157,0,255,0.2)] hover:shadow-[0_0_30px_rgba(157,0,255,0.6)] cursor-pointer" data-url="https://geelybsd.id">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Launch Experience
                        </button>
                    </div>
                    
                    <!-- Container Iframe -->
                    <div class="iframe-container absolute inset-0 opacity-0 transition-opacity duration-700">
                        <div class="absolute inset-0 z-10 pointer-events-none shadow-[inset_0_0_20px_rgba(0,0,0,0.5)]"></div>
                        <iframe src="about:blank" class="w-full h-full border-none custom-scrollbar" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- WORK PROCESS -->
<section class="py-32 bg-[#080815] relative">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-6xl font-black text-white mb-20 text-center uppercase tracking-tight font-space">How We <span class="text-[#9d00ff]">Deploy</span></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <!-- Connecting Line for Desktop -->
            <div class="hidden md:block absolute top-12 left-10 right-10 h-[1px] bg-gradient-to-r from-transparent via-white/20 to-transparent z-0"></div>

            <div class="gsap-process relative z-10 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-[#0a0a14] border border-white/20 flex items-center justify-center text-3xl font-black text-white mb-6 shadow-[0_0_30px_rgba(255,255,255,0.05)]">1</div>
                <h4 class="text-xl font-bold text-white mb-2">Architect</h4>
                <p class="text-gray-500 text-sm">Merancang struktur database, wireframe, dan alur UX sebelum satu baris kode pun ditulis.</p>
            </div>
            
            <div class="gsap-process relative z-10 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-[#0a0a14] border border-[#f9005b]/50 flex items-center justify-center text-3xl font-black text-[#f9005b] mb-6 shadow-[0_0_30px_rgba(249,0,91,0.2)]">2</div>
                <h4 class="text-xl font-bold text-white mb-2">Develop</h4>
                <p class="text-gray-500 text-sm">Mengembangkan *frontend* interaktif dan *backend* yang aman menggunakan *stack* terbaik.</p>
            </div>

            <div class="gsap-process relative z-10 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-[#0a0a14] border border-[#9d00ff]/50 flex items-center justify-center text-3xl font-black text-[#9d00ff] mb-6 shadow-[0_0_30px_rgba(157,0,255,0.2)]">3</div>
                <h4 class="text-xl font-bold text-white mb-2">Animate</h4>
                <p class="text-gray-500 text-sm">Menyuntikkan nyawa ke dalam antarmuka. Transisi halaman, WebGL, dan *micro-interactions*.</p>
            </div>

            <div class="gsap-process relative z-10 flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-white text-black flex items-center justify-center text-3xl font-black mb-6 shadow-[0_0_40px_rgba(255,255,255,0.4)]">4</div>
                <h4 class="text-xl font-bold text-white mb-2">Launch</h4>
                <p class="text-gray-500 text-sm">Optimasi performa, SEO teknis, audit keamanan, dan *deployment* ke server produksi.</p>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-24 bg-[#0a0a14] border-t border-white/10 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#f9005b]/10 via-[#0a0a14] to-[#0a0a14]"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-8 font-space">
            Ready to Build <br>The <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Impossible?</span>
        </h2>
        <a href="mailto:rizkialiakhbar@gmail.com" class="group relative inline-flex items-center justify-center bg-white text-black font-black text-xl px-10 py-5 overflow-hidden rounded-full transition-all hover:scale-105">
            <span class="relative z-10 flex items-center gap-3">
                Mulai Proyek Web Anda
                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </span>
        </a>
    </div>
</section>

<!-- Eksternal Script Dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<!-- Memanggil JS Eksternal -->
<script src="{{ asset('js/web-development.js') }}"></script>
@endsection