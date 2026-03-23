@extends('layouts.main')

@section('title', 'UI/UX Design - Lund\'or Imagine Digital')

@section('content')
<!-- Font Khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<style>
    .font-space {
        font-family: 'Space Grotesk', sans-serif;
    }
    
    /* Grid Presisi ala Software Desain (Figma/Sketch) */
    .bg-design-grid {
        background-size: 50px 50px;
        background-image: 
            linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    }

    /* Efek Kaca (Glassmorphism) - Dark Theme */
    .glass-panel {
        background: rgba(10, 10, 15, 0.4);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    }

    /* Efek Kaca (Glassmorphism) - Light Theme */
    .glass-panel-light {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.05);
    }

    /* Efek Glow Tracking pada Card (akan digerakkan oleh JS) */
    .tracking-card {
        position: relative;
        overflow: hidden;
    }
    .tracking-card::before {
        content: '';
        position: absolute;
        top: var(--y, 0);
        left: var(--x, 0);
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(157, 0, 255, 0.15) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 0;
    }
    .tracking-card:hover::before {
        opacity: 1;
    }
    .tracking-card > * {
        position: relative;
        z-index: 1;
    }

    /* Teks Transparan Outline - Dark Theme */
    .text-outline-ui {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.15);
    }

    /* Teks Transparan Outline - Light Theme */
    .text-stroke-light {
        color: transparent;
        -webkit-text-stroke: 1px rgba(0, 0, 0, 0.2);
    }

    /* Floating Animation */
    @keyframes float-ui {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .animate-float-ui {
        animation: float-ui 6s ease-in-out infinite;
    }

    /* Mini UI Animations */
    @keyframes pulse-bar {
        0%, 100% { height: 30%; }
        50% { height: 80%; }
    }
    .animate-pulse-bar {
        animation: pulse-bar 2s ease-in-out infinite;
    }
</style>

<!-- 1. HERO SECTION: INTERACTIVE & SLEEK (DARK) -->
<section class="relative w-full min-h-screen bg-[#05050a] flex flex-col items-center justify-center overflow-hidden bg-design-grid pt-24 pb-12">
    <!-- Ambient Glow -->
    <div class="absolute top-1/4 left-1/4 w-[600px] h-[600px] bg-[#9d00ff]/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-[#f9005b]/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 w-full flex flex-col items-center text-center">
        <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-5 py-2 mb-8 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-[#9d00ff] animate-ping"></span>
            <span class="text-gray-300 font-mono text-xs tracking-widest uppercase">Pixel Perfect Precision</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white uppercase tracking-tighter mb-6 font-space leading-[1.1]">
            Design That Breathes.<br>
            <span class="text-outline-ui">Experiences That</span> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#9d00ff] to-[#f9005b]">Convert.</span>
        </h1>
        
        <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto font-space leading-relaxed mb-12">
            Estetika tanpa kemudahan penggunaan hanyalah karya seni. Kami membangun antarmuka digital yang memandu pengguna Anda dari klik pertama hingga konversi terakhir tanpa hambatan.
        </p>

        <!-- Magnetic Button Demo -->
        <a href="#philosophy" class="magnetic-btn inline-flex items-center justify-center bg-white text-black font-black text-sm md:text-base px-10 py-5 rounded-full transition-colors hover:bg-gray-200 uppercase tracking-widest font-space">
            <span>Explore The Interface</span>
        </a>
    </div>

    <!-- Floating UI Elements Mockup (Mendemonstrasikan UI) -->
    <div class="absolute bottom-0 left-0 w-full h-[40vh] pointer-events-none overflow-hidden hidden md:block">
        <!-- Mockup Card 1 -->
        <div class="absolute -bottom-10 left-[15%] w-64 h-40 glass-panel rounded-2xl p-4 animate-float-ui border-t border-l border-white/20" style="animation-delay: 0s;">
            <div class="w-full h-4 bg-white/10 rounded-full mb-4"></div>
            <div class="w-3/4 h-4 bg-white/10 rounded-full mb-8"></div>
            <div class="flex gap-2">
                <div class="w-10 h-10 rounded-full bg-[#f9005b]/20"></div>
                <div class="w-10 h-10 rounded-full bg-[#9d00ff]/20"></div>
            </div>
        </div>
        <!-- Mockup Card 2 -->
        <div class="absolute bottom-10 right-[15%] w-72 h-48 glass-panel rounded-2xl p-5 animate-float-ui border-t border-r border-white/20" style="animation-delay: -3s;">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#9d00ff] to-[#f9005b]"></div>
                <div>
                    <div class="w-24 h-3 bg-white/20 rounded-full mb-2"></div>
                    <div class="w-16 h-2 bg-white/10 rounded-full"></div>
                </div>
            </div>
            <div class="w-full h-12 bg-white/5 rounded-xl border border-white/10 flex items-center justify-between px-4">
                <span class="w-16 h-2 bg-white/20 rounded-full"></span>
                <span class="w-8 h-4 bg-[#f9005b] rounded-full"></span>
            </div>
        </div>
    </div>
</section>

<!-- 2. THE PHILOSOPHY (Mengapa UX Penting) - LIGHT THEME -->
<section id="philosophy" class="py-24 bg-[#f8f9fa] relative z-20 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative">
                <!-- Abstract UI Representation -->
                <div class="relative w-full aspect-square max-w-md mx-auto">
                    <div class="absolute inset-0 border border-gray-300 rounded-full animate-[spin_20s_linear_infinite]"></div>
                    <div class="absolute inset-4 border border-gray-300 rounded-full animate-[spin_15s_linear_infinite_reverse] border-dashed"></div>
                    <div class="absolute inset-12 bg-gradient-to-br from-[#9d00ff]/10 to-[#f9005b]/10 rounded-full blur-2xl"></div>
                    
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-6">
                        <div class="glass-panel-light px-6 py-4 rounded-2xl flex items-center gap-4 transform -translate-x-12 shadow-lg">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold">✕</div>
                            <div>
                                <div class="text-xs text-gray-500 font-mono">Bounce Rate</div>
                                <div class="text-xl font-black text-gray-900">78% (Bad UX)</div>
                            </div>
                        </div>
                        <div class="glass-panel-light px-6 py-4 rounded-2xl flex items-center gap-4 transform translate-x-12 shadow-lg border border-[#9d00ff]/20">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">✓</div>
                            <div>
                                <div class="text-xs text-gray-500 font-mono">Conversion Rate</div>
                                <div class="text-xl font-black text-gray-900">+340% (Good UX)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2 text-left">
                <div class="inline-block px-3 py-1 bg-[#9d00ff]/10 border border-[#9d00ff]/20 text-[#9d00ff] font-mono text-xs uppercase tracking-widest rounded-full mb-6">The Hard Truth</div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 uppercase tracking-tighter mb-6 font-space">
                    Desain Buruk <br>Membunuh <span class="text-stroke-light">Bisnis Anda.</span>
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6 font-space">
                    Pengguna modern tidak memiliki kesabaran. Jika website atau aplikasi Anda membingungkan dalam 3 detik pertama, mereka akan pergi dan beralih ke kompetitor Anda.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed mb-8 font-space">
                    Kami merancang antarmuka berdasarkan psikologi manusia. Memetakan *user journey* yang logis, mengurangi *cognitive load*, dan membuat setiap interaksi terasa memuaskan (rewarding).
                </p>
                
                <div class="flex gap-4">
                    <div class="w-1/2 p-4 border border-gray-200 rounded-2xl bg-white shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-3xl font-black text-[#f9005b] mb-1 font-space">0.05s</div>
                        <div class="text-xs text-gray-500 font-mono uppercase tracking-widest">Waktu bagi user menilai brand Anda</div>
                    </div>
                    <div class="w-1/2 p-4 border border-gray-200 rounded-2xl bg-white shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-3xl font-black text-[#9d00ff] mb-1 font-space">$100</div>
                        <div class="text-xs text-gray-500 font-mono uppercase tracking-widest">ROI untuk setiap $1 yang diinvestasikan ke UX</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. THE PROCESS (Tahapan Desain UX) - DARK THEME -->
<section class="py-24 bg-[#080815] relative z-20 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 font-space text-center">
                The Engineering <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#9d00ff] to-[#f9005b]">Process.</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="tracking-card glass-panel rounded-3xl p-8 group border border-white/5 hover:border-white/20">
                <div class="text-5xl font-black text-white/10 font-space mb-4 group-hover:text-white/20 transition-colors">01</div>
                <h3 class="text-xl font-bold text-white mb-3 font-space">Research & Empathy</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Memahami siapa target audiens Anda, apa masalah mereka, dan bagaimana mereka berinteraksi dengan teknologi. Kami membangun User Persona & User Journey Map.</p>
            </div>

            <!-- Step 2 -->
            <div class="tracking-card glass-panel rounded-3xl p-8 group border border-white/5 hover:border-white/20">
                <div class="text-5xl font-black text-white/10 font-space mb-4 group-hover:text-[#9d00ff]/30 transition-colors">02</div>
                <h3 class="text-xl font-bold text-white mb-3 font-space">Wireframing (UX)</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Menyusun kerangka dasar (blueprint) dari struktur informasi. Fokus pada fungsionalitas, navigasi, dan tata letak sebelum memikirkan visual warna.</p>
            </div>

            <!-- Step 3 -->
            <div class="tracking-card glass-panel rounded-3xl p-8 group border border-white/5 hover:border-white/20">
                <div class="text-5xl font-black text-white/10 font-space mb-4 group-hover:text-[#f9005b]/30 transition-colors">03</div>
                <h3 class="text-xl font-bold text-white mb-3 font-space">Visual Interface (UI)</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Menyuntikkan nyawa pada wireframe. Pemilihan tipografi, palet warna, iconografi, dan *spacing* yang menciptakan estetika modern dan berkelas.</p>
            </div>

            <!-- Step 4 -->
            <div class="tracking-card glass-panel rounded-3xl p-8 group border border-white/5 hover:border-white/20">
                <div class="text-5xl font-black text-white/10 font-space mb-4 group-hover:text-white/20 transition-colors">04</div>
                <h3 class="text-xl font-bold text-white mb-3 font-space">Prototyping & Test</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Menciptakan purwarupa interaktif yang bisa diklik. Kami mengujinya untuk memastikan tidak ada celah UX sebelum diserahkan ke tim Developer (Handoff).</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. FEATURED INTERFACES (Showcase UI/UX) - PURE CODE UI - LIGHT THEME -->
<section class="py-24 bg-[#f8f9fa] relative z-20 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16 text-center">
            <div class="inline-block px-3 py-1 bg-[#f9005b]/10 border border-[#f9005b]/20 text-[#f9005b] font-mono text-xs uppercase tracking-widest rounded-full mb-6">Real Pure Code Mockups</div>
            <h2 class="text-4xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter mb-4 font-space">
                Digital <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Craftsmanship.</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto font-space">Bukan sekadar *placeholder* atau gambar statis. Semua desain antarmuka di dalam kartu di bawah ini dirender murni menggunakan <strong class="text-gray-900">100% HTML & Tailwind CSS</strong>. Presisi visual *pixel-perfect* tanpa mengorbankan performa browser.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: Mobile Banking App (Highly Detailed Pure CSS) -->
            <div class="tracking-card glass-panel-light rounded-3xl overflow-hidden group border border-gray-200 flex flex-col hover:border-[#9d00ff]/40 transition-colors bg-white shadow-sm">
                <div class="h-[460px] bg-[#f0f2f5] relative flex items-center justify-center p-6 border-b border-gray-200 overflow-hidden">
                    
                    <!-- Decorative Background -->
                    <div class="absolute top-10 left-10 w-40 h-40 bg-pink-300/30 rounded-full blur-[40px]"></div>
                    <div class="absolute bottom-10 right-10 w-40 h-40 bg-purple-300/30 rounded-full blur-[40px]"></div>

                    <!-- Mobile Phone Frame -->
                    <div class="w-[250px] h-full max-h-[430px] bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] border-[6px] border-gray-900 relative overflow-hidden flex flex-col group-hover:scale-105 transition-transform duration-700">
                        <!-- Dynamic Island / Notch -->
                        <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-5 bg-black rounded-full z-30"></div>
                        
                        <!-- Header App -->
                        <div class="pt-8 px-5 pb-3 flex justify-between items-center bg-white z-20 relative">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-500 to-pink-500 p-[2px] shadow-sm">
                                    <div class="w-full h-full bg-white rounded-full border-2 border-white overflow-hidden flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-300 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <p class="text-[9px] text-gray-500 font-medium leading-none mb-0.5">Welcome back,</p>
                                    <p class="text-xs font-black text-gray-900 font-space tracking-tight leading-none">Alex Mercer</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center relative cursor-pointer hover:bg-gray-100 transition-colors">
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                                <svg class="w-4 h-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            </div>
                        </div>

                        <div class="overflow-y-auto overflow-x-hidden flex-1 pb-6 hide-scrollbar relative z-10 bg-white">
                            <!-- Balance Card (Mesh Gradient Style) -->
                            <div class="mx-5 mt-2 p-4 rounded-2xl bg-gray-900 text-white relative shadow-xl overflow-hidden shrink-0 group/card cursor-pointer">
                                <!-- Inner Mesh Gradients -->
                                <div class="absolute -top-12 -right-10 w-32 h-32 bg-pink-500/30 rounded-full blur-2xl group-hover/card:bg-pink-500/50 transition-colors duration-500"></div>
                                <div class="absolute -bottom-8 -left-8 w-28 h-28 bg-purple-500/30 rounded-full blur-2xl group-hover/card:bg-purple-500/50 transition-colors duration-500"></div>
                                
                                <div class="relative z-10 flex justify-between items-start mb-2">
                                    <p class="text-[9px] text-gray-300 font-medium uppercase tracking-wider">Total Balance</p>
                                    <svg class="w-4 h-4 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <h4 class="text-[26px] font-black tracking-tighter mb-6 font-space relative z-10">$24,562<span class="text-white/60 text-sm font-medium">.50</span></h4>
                                
                                <div class="flex justify-between items-end relative z-10">
                                    <p class="text-[11px] font-mono tracking-[0.2em] text-white/80">**** 4289</p>
                                    <!-- CSS Mastercard Logo -->
                                    <div class="flex">
                                        <div class="w-5 h-5 rounded-full bg-red-500/90 mix-blend-screen relative -mr-2"></div>
                                        <div class="w-5 h-5 rounded-full bg-yellow-500/90 mix-blend-screen"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="flex justify-between px-6 mt-6 shrink-0">
                                <div class="flex flex-col items-center gap-1.5 cursor-pointer hover:-translate-y-1 transition-transform">
                                    <div class="w-11 h-11 rounded-full bg-[#f3e8ff] flex items-center justify-center text-purple-600 shadow-sm border border-purple-100"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg></div>
                                    <span class="text-[9px] font-bold text-gray-700">Send</span>
                                </div>
                                <div class="flex flex-col items-center gap-1.5 cursor-pointer hover:-translate-y-1 transition-transform">
                                    <div class="w-11 h-11 rounded-full bg-[#ffe4e6] flex items-center justify-center text-pink-600 shadow-sm border border-pink-100"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7-7V3" /></svg></div>
                                    <span class="text-[9px] font-bold text-gray-700">Receive</span>
                                </div>
                                <div class="flex flex-col items-center gap-1.5 cursor-pointer hover:-translate-y-1 transition-transform">
                                    <div class="w-11 h-11 rounded-full bg-[#e0f2fe] flex items-center justify-center text-blue-600 shadow-sm border border-blue-100"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></div>
                                    <span class="text-[9px] font-bold text-gray-700">Topup</span>
                                </div>
                                <div class="flex flex-col items-center gap-1.5 cursor-pointer hover:-translate-y-1 transition-transform">
                                    <div class="w-11 h-11 rounded-full bg-gray-50 flex items-center justify-center text-gray-700 shadow-sm border border-gray-200"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg></div>
                                    <span class="text-[9px] font-bold text-gray-700">More</span>
                                </div>
                            </div>

                            <!-- Recent Transactions -->
                            <div class="px-5 mt-7 flex-1 flex flex-col">
                                <div class="flex justify-between items-center mb-4">
                                    <h5 class="text-xs font-black text-gray-900 font-space tracking-wide">Recent Activity</h5>
                                    <span class="text-[9px] text-[#9d00ff] font-bold cursor-pointer">See All</span>
                                </div>
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between group/tx cursor-pointer p-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 border border-orange-100 group-hover/tx:scale-105 transition-transform"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg></div>
                                            <div class="flex flex-col justify-center">
                                                <p class="text-[11px] font-bold text-gray-900 leading-none mb-1">Electric Bill</p>
                                                <p class="text-[8px] text-gray-500 font-medium leading-none">Today, 09:24 AM</p>
                                            </div>
                                        </div>
                                        <span class="text-[11px] font-black text-gray-900 font-space">-$45.00</span>
                                    </div>
                                    <div class="flex items-center justify-between group/tx cursor-pointer p-1 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-500 border border-green-100 group-hover/tx:scale-105 transition-transform"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg></div>
                                            <div class="flex flex-col justify-center">
                                                <p class="text-[11px] font-bold text-gray-900 leading-none mb-1">Monthly Salary</p>
                                                <p class="text-[8px] text-gray-500 font-medium leading-none">Yesterday</p>
                                            </div>
                                        </div>
                                        <span class="text-[11px] font-black text-green-500 font-space">+$3,240.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modern Home Indicator -->
                        <div class="absolute bottom-1.5 left-1/2 -translate-x-1/2 w-20 h-1 bg-gray-300 rounded-full z-20"></div>
                    </div>
                    
                </div>
                <div class="p-6 relative z-10 bg-white backdrop-blur-md flex-grow border-t border-gray-100">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-gray-600 text-[10px] font-mono uppercase mb-3 inline-block font-bold border border-gray-200">Mobile FinTech UI</span>
                    <h3 class="text-xl font-black text-gray-900 mb-2 font-space">Nexus Banking</h3>
                    <p class="text-gray-600 text-sm">Desain aplikasi finansial yang menekankan keterbacaan data tinggi melalui *spacing* presisi dan hierarki visual yang jelas.</p>
                </div>
            </div>

            <!-- Card 2: SaaS Web Dashboard (Highly Detailed Pure CSS) -->
            <div class="tracking-card glass-panel-light rounded-3xl overflow-hidden group border border-gray-200 flex flex-col md:translate-y-8 hover:border-[#f9005b]/40 transition-colors bg-white shadow-sm">
                <div class="h-[460px] bg-[#f0f2f5] relative flex items-center justify-center p-6 border-b border-gray-200 overflow-hidden">
                    
                    <!-- Web Browser / SaaS Dashboard Frame -->
                    <div class="w-full max-w-[340px] h-[320px] bg-white rounded-xl shadow-[0_25px_50px_rgba(0,0,0,0.15)] border border-gray-200 flex flex-col group-hover:scale-105 transition-transform duration-700 overflow-hidden relative">
                        <!-- macOS Window Header -->
                        <div class="h-7 bg-gray-50 border-b border-gray-200 flex items-center px-3 gap-1.5 shrink-0">
                            <div class="w-3 h-3 rounded-full bg-[#ff5f56] border border-[#e0443e]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#ffbd2e] border border-[#dea123]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#27c93f] border border-[#1aab29]"></div>
                        </div>
                        
                        <!-- Dashboard Body -->
                        <div class="flex flex-1 overflow-hidden">
                            <!-- Sidebar (Dark Mode style) -->
                            <div class="w-16 bg-[#0a0a14] flex flex-col items-center py-5 gap-6 shrink-0 border-r border-gray-800">
                                <!-- Logo -->
                                <div class="w-8 h-8 bg-gradient-to-br from-[#9d00ff] to-[#f9005b] rounded-lg shadow-lg flex items-center justify-center">
                                    <div class="w-3.5 h-3.5 border-[2px] border-white rounded-full"></div>
                                </div>
                                <div class="w-8 border-t border-gray-800"></div>
                                <!-- Nav Icons -->
                                <div class="w-10 h-10 rounded-xl bg-white/10 text-white flex items-center justify-center cursor-pointer"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg></div>
                                <div class="w-10 h-10 rounded-xl hover:bg-white/5 text-gray-500 hover:text-gray-300 flex items-center justify-center transition-colors cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                <div class="w-10 h-10 rounded-xl hover:bg-white/5 text-gray-500 hover:text-gray-300 flex items-center justify-center transition-colors cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                            </div>
                            
                            <!-- Main Content Area -->
                            <div class="flex-1 p-5 bg-gray-50 flex flex-col gap-4 overflow-hidden">
                                <!-- Top Bar -->
                                <div class="flex justify-between items-center shrink-0">
                                    <div>
                                        <h4 class="text-sm font-black text-gray-900 font-space tracking-tight leading-none mb-1">Analytics</h4>
                                        <p class="text-[9px] text-gray-500 font-medium">Overview for this month</p>
                                    </div>
                                    <div class="px-2.5 py-1.5 bg-white border border-gray-200 rounded-md text-[9px] text-gray-700 font-bold flex items-center gap-1.5 shadow-sm cursor-pointer hover:bg-gray-50 transition-colors">
                                        Last 30 Days <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                
                                <!-- Analytics Stat Cards -->
                                <div class="grid grid-cols-2 gap-3 shrink-0">
                                    <div class="p-3.5 border border-gray-200 rounded-xl shadow-sm bg-white hover:shadow-md transition-shadow cursor-pointer">
                                        <div class="flex justify-between items-start mb-2">
                                            <p class="text-[9px] text-gray-500 uppercase tracking-widest font-bold">Revenue</p>
                                            <div class="w-5 h-5 rounded-md bg-green-50 text-green-600 flex items-center justify-center border border-green-100"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                                        </div>
                                        <p class="text-lg font-black text-gray-900 font-space mb-1.5">$42,850</p>
                                        <div class="flex items-center gap-1 text-[9px] text-green-600 font-bold bg-green-50 px-1.5 py-0.5 rounded w-max border border-green-100">
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> +14.5%
                                        </div>
                                    </div>
                                    <div class="p-3.5 border border-gray-200 rounded-xl shadow-sm bg-white hover:shadow-md transition-shadow cursor-pointer">
                                        <div class="flex justify-between items-start mb-2">
                                            <p class="text-[9px] text-gray-500 uppercase tracking-widest font-bold">Active Users</p>
                                            <div class="w-5 h-5 rounded-md bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg></div>
                                        </div>
                                        <p class="text-lg font-black text-gray-900 font-space mb-1.5">8,234</p>
                                        <div class="flex items-center gap-1 text-[9px] text-red-600 font-bold bg-red-50 px-1.5 py-0.5 rounded w-max border border-red-100">
                                            <svg class="w-2.5 h-2.5 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> -2.4%
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Complex Chart Area -->
                                <div class="flex-1 border border-gray-200 rounded-xl p-4 flex flex-col shadow-sm relative group/chart bg-white overflow-hidden">
                                    <div class="flex justify-between items-center mb-3 relative z-10">
                                        <p class="text-[10px] font-bold text-gray-800">Traffic Source</p>
                                        <div class="flex gap-1.5">
                                            <span class="w-5 h-1.5 bg-gray-200 rounded-full"></span>
                                            <span class="w-5 h-1.5 bg-gray-200 rounded-full"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Main Graph -->
                                    <div class="flex-1 flex items-end justify-between gap-1.5 relative border-b border-gray-200 pb-1">
                                        <!-- Grid lines -->
                                        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                            <div class="w-full h-px bg-gray-100"></div>
                                            <div class="w-full h-px bg-gray-100"></div>
                                            <div class="w-full h-px bg-gray-100"></div>
                                            <div class="w-full h-px bg-gray-100"></div>
                                        </div>
                                        
                                        <!-- Animated CSS Bars -->
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[30%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[55%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[40%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                        
                                        <!-- Active Bar with Tooltip -->
                                        <div class="w-full bg-gradient-to-t from-[#9d00ff] to-[#bc13fe] rounded-t-[2px] h-[85%] relative z-20 cursor-pointer shadow-[0_0_10px_rgba(157,0,255,0.3)]">
                                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[8px] font-bold px-2.5 py-1.5 rounded shadow-lg opacity-0 group-hover/chart:opacity-100 transition-all duration-300 whitespace-nowrap transform -translate-y-2 group-hover/chart:translate-y-0">
                                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 transform rotate-45"></div>
                                                $8,450
                                            </div>
                                        </div>
                                        
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[60%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[75%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                        <div class="w-full bg-[#f3e8ff] hover:bg-[#9d00ff] rounded-t-[2px] h-[95%] transition-colors duration-300 relative z-10 cursor-pointer"></div>
                                    </div>
                                    
                                    <!-- X-Axis Labels -->
                                    <div class="flex justify-between mt-1.5 px-1">
                                        <span class="text-[7px] text-gray-400 font-bold">Mon</span>
                                        <span class="text-[7px] text-gray-400 font-bold">Tue</span>
                                        <span class="text-[7px] text-gray-400 font-bold">Wed</span>
                                        <span class="text-[7px] text-gray-900 font-black">Thu</span>
                                        <span class="text-[7px] text-gray-400 font-bold">Fri</span>
                                        <span class="text-[7px] text-gray-400 font-bold">Sat</span>
                                        <span class="text-[7px] text-gray-400 font-bold">Sun</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 relative z-10 bg-white backdrop-blur-md flex-grow border-t border-gray-100">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-gray-600 text-[10px] font-mono uppercase mb-3 inline-block font-bold border border-gray-200">SaaS Web App UI</span>
                    <h3 class="text-xl font-black text-gray-900 mb-2 font-space">Aether Analytics</h3>
                    <p class="text-gray-600 text-sm">Dashboard B2B dengan komposisi *sidebar dark-mode* dipadu dengan area grafik terang agar pengguna tetap fokus pada data.</p>
                </div>
            </div>

            <!-- Card 3: Smart Home IoT App (Glassmorphism Pure CSS) -->
            <div class="tracking-card glass-panel-light rounded-3xl overflow-hidden group border border-gray-200 flex flex-col lg:translate-y-16 hover:border-[#9d00ff]/40 transition-colors bg-white shadow-sm">
                <div class="h-[460px] bg-gray-900 relative overflow-hidden flex items-center justify-center p-6 border-b border-gray-800">
                    
                    <!-- IoT App Mobile Frame (Dark Glassmorphism Style) -->
                    <div class="w-[250px] h-[430px] bg-[#0a0a14] rounded-[2.5rem] shadow-2xl border-[6px] border-black relative flex flex-col group-hover:scale-105 transition-all duration-700 p-5 text-white overflow-hidden">
                        
                        <!-- Atmospheric Abstract Blobs inside the App -->
                        <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#f9005b]/40 rounded-full blur-[40px] mix-blend-screen pointer-events-none"></div>
                        <div class="absolute bottom-10 -left-10 w-48 h-48 bg-[#9d00ff]/40 rounded-full blur-[40px] mix-blend-screen pointer-events-none"></div>
                        
                        <!-- Top Notch -->
                        <div class="absolute top-1 left-1/2 -translate-x-1/2 w-16 h-4 bg-black rounded-b-xl z-30"></div>

                        <!-- Header -->
                        <div class="flex justify-between items-end relative z-10 mt-4 mb-6">
                            <div>
                                <h5 class="text-[10px] text-gray-400 font-mono tracking-widest uppercase mb-1">Living Room</h5>
                                <h4 class="text-xl font-black font-space leading-none">24°C <span class="text-[10px] font-normal text-gray-400 ml-1 align-middle">Cloudy</span></h4>
                            </div>
                            <div class="w-9 h-9 rounded-full border border-white/20 bg-white/5 backdrop-blur-md flex items-center justify-center cursor-pointer hover:bg-white/10 transition-colors">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                        </div>

                        <!-- Active Device Status Card (Glassmorphism) -->
                        <div class="w-full p-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-[0_15px_30px_rgba(0,0,0,0.5)] mb-5 relative z-10 group/device cursor-pointer">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center"><svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg></div>
                                    <span class="text-xs font-bold font-space">Smart Lamp</span>
                                </div>
                                <!-- CSS Toggle Switch Active -->
                                <div class="w-10 h-5 bg-[#f9005b] rounded-full relative shadow-[0_0_12px_rgba(249,0,91,0.6)]">
                                    <div class="w-4 h-4 bg-white rounded-full absolute right-0.5 top-0.5 shadow-sm"></div>
                                </div>
                            </div>
                            
                            <!-- Brightness Slider -->
                            <div class="w-full h-1.5 bg-black/40 rounded-full mt-2 overflow-hidden relative">
                                <div class="w-[80%] h-full bg-gradient-to-r from-[#9d00ff] to-[#f9005b] rounded-full relative shadow-[0_0_10px_#f9005b]"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-[8px] text-gray-400 font-medium">Brightness</span>
                                <span class="text-[8px] font-bold text-white">80%</span>
                            </div>
                        </div>

                        <!-- Devices Grid -->
                        <h5 class="text-[10px] font-bold mb-3 relative z-10 font-space tracking-wide">Connected Devices</h5>
                        <div class="grid grid-cols-2 gap-3 relative z-10 flex-1">
                            <!-- Device 1: AC (Inactive) -->
                            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-[1rem] p-3.5 flex flex-col justify-between hover:bg-white/10 transition-colors cursor-pointer group/ac">
                                <div class="flex justify-between items-start">
                                    <div class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                                    <div class="w-6 h-3 bg-black/50 border border-white/10 rounded-full relative">
                                        <div class="w-2.5 h-2.5 bg-gray-500 rounded-full absolute left-[1px] top-[1px]"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-300 mb-0.5">Air Cond.</p>
                                    <p class="text-[8px] text-gray-500 font-mono font-bold">Off</p>
                                </div>
                            </div>
                            <!-- Device 2: Speaker (Active) -->
                            <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-md border border-[#9d00ff]/40 rounded-[1rem] p-3.5 flex flex-col justify-between cursor-pointer shadow-[0_0_20px_rgba(157,0,255,0.15)] group/speaker hover:shadow-[0_0_25px_rgba(157,0,255,0.3)] transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="w-7 h-7 rounded-full bg-[#9d00ff]/20 flex items-center justify-center"><svg class="w-3.5 h-3.5 text-[#9d00ff]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg></div>
                                    <div class="w-6 h-3 bg-[#9d00ff] rounded-full relative shadow-[0_0_8px_#9d00ff]">
                                        <div class="w-2.5 h-2.5 bg-white rounded-full absolute right-[1px] top-[1px] shadow-sm"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-white mb-0.5">Speaker</p>
                                    <p class="text-[8px] text-[#9d00ff] font-mono font-bold">Playing</p>
                                </div>
                            </div>
                        </div>

                        <!-- Home Indicator -->
                        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-24 h-1 bg-white/30 rounded-full z-20"></div>
                    </div>
                    
                </div>
                <div class="p-6 relative z-10 bg-white backdrop-blur-md flex-grow border-t border-gray-100">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-gray-600 text-[10px] font-mono uppercase mb-3 inline-block font-bold border border-gray-200">IoT App UI</span>
                    <h3 class="text-xl font-black text-gray-900 mb-2 font-space">Lumina Smart Home</h3>
                    <p class="text-gray-600 text-sm">Implementasi *Glassmorphism UI* tingkat lanjut yang menggabungkan estetika futuristik dengan *usability* kontrol perangkat rumah.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- 5. THE DELIVERABLES (Apa yang Diberikan) - DIUBAH MENJADI DARK THEME -->
<section class="py-24 bg-[#080815] relative z-20 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16 md:flex justify-between items-end">
            <div class="max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-4 font-space">
                    Pixel-Perfect <br><span class="text-[#9d00ff]">Deliverables.</span>
                </h2>
                <p class="text-gray-400">Bukan sekadar gambar JPG yang mati. Kami menyerahkan ekosistem desain yang siap dikembangkan (Production-Ready) oleh tim *Engineering* Anda.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Box 1: Design System -->
            <div class="lg:col-span-2 tracking-card glass-panel rounded-3xl p-8 min-h-[350px] flex flex-col justify-between">
                <div class="w-12 h-12 bg-[#0a0a14] rounded-xl flex items-center justify-center text-[#9d00ff] mb-6 border border-white/10 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-white mb-4 font-space">Scalable Design System</h3>
                    <p class="text-gray-400 mb-6 max-w-lg">Kami tidak mendesain halaman per halaman. Kami membangun "Design System" (Komponen, Variant, Style Guide) di Figma. Jika di masa depan aplikasi Anda berkembang, tim Anda tinggal menggunakan komponen yang sudah ada tanpa merusak konsistensi brand.</p>
                </div>
                <div class="flex gap-3 flex-wrap mt-auto">
                    <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-xs text-gray-300 font-mono shadow-sm">Typography Tokens</span>
                    <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-xs text-gray-300 font-mono shadow-sm">Color Variables</span>
                    <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-xs text-gray-300 font-mono shadow-sm">Master Components</span>
                </div>
            </div>

            <!-- Box 2: Prototyping -->
            <div class="tracking-card glass-panel rounded-3xl p-8 min-h-[350px] flex flex-col justify-between">
                <div class="w-12 h-12 bg-[#0a0a14] rounded-xl flex items-center justify-center text-[#f9005b] mb-6 border border-white/10 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-white mb-4 font-space">Interactive Prototypes</h3>
                    <p class="text-gray-400 text-sm">Rasakan pengalaman menggunakan aplikasi sebelum satu baris kode pun ditulis. Lengkap dengan animasi transisi dan *micro-interactions*.</p>
                </div>
            </div>

            <!-- Box 3: Multi-platform -->
            <div class="tracking-card glass-panel rounded-3xl p-8 min-h-[350px] flex flex-col justify-between">
                <div class="w-12 h-12 bg-[#0a0a14] rounded-xl flex items-center justify-center text-gray-300 mb-6 border border-white/10 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-white mb-4 font-space">Responsive Mastery</h3>
                    <p class="text-gray-400 text-sm">Desain yang beradaptasi sempurna di layar 4K, laptop, tablet, hingga smartphone terkecil tanpa mengorbankan estetika.</p>
                </div>
            </div>

            <!-- Box 4: Dev Handoff -->
            <div class="lg:col-span-2 tracking-card glass-panel rounded-3xl p-8 min-h-[350px] flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent skew-x-12 translate-x-[-150%] animate-[shimmer_5s_infinite]"></div>
                <div class="w-full md:w-1/2 relative z-10">
                    <h3 class="text-3xl font-black text-white mb-4 font-space">Seamless Developer Handoff</h3>
                    <p class="text-gray-400 mb-6">Mimpi buruk *Developer* adalah file desain yang berantakan. Kami menyerahkan file Figma yang sangat rapi, terstruktur dengan *Auto Layout*, dan dilengkapi catatan dokumentasi agar *Engineer* dapat melakukan *slicing* kode dengan presisi 100%.</p>
                </div>
                <div class="w-full md:w-1/2 h-full min-h-[150px] bg-black/50 rounded-2xl border border-white/10 flex items-center justify-center p-6 shadow-xl relative z-10">
                    <div class="text-left w-full">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="font-mono text-sm text-green-400">> export figma_assets</div>
                        <div class="font-mono text-sm text-gray-400">> generating css tokens...</div>
                        <div class="font-mono text-sm text-gray-400">> standardizing padding...</div>
                        <div class="font-mono text-sm text-white font-bold">> STATUS: READY TO CODE</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 6. CALL TO ACTION (DIUBAH MENJADI LIGHT THEME) -->
<section class="py-32 relative overflow-hidden bg-[#f8f9fa] z-20 border-t border-gray-200">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#9d00ff]/10 via-[#f8f9fa] to-[#f8f9fa]"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter mb-8 font-space">
            Upgrade Your <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#9d00ff] to-[#f9005b]">User Experience.</span>
        </h2>
        <p class="text-gray-600 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-space">
            Jangan biarkan antarmuka yang buruk menghalangi produk hebat Anda. Mari diskusikan arsitektur digital Anda selanjutnya.
        </p>
        
        <!-- Magnetic Button untuk CTA -->
        <a href="mailto:rizkialiakhbar@gmail.com" class="magnetic-btn inline-flex items-center justify-center bg-gray-900 text-white font-black text-lg px-12 py-5 rounded-full transition-all hover:bg-black shadow-[0_0_40px_rgba(0,0,0,0.1)]">
            <span>Start Designing</span>
        </a>
    </div>
</section>

<!-- SCRIPT UNTUK EFEK UI/UX INTERAKTIF (Magnetic Button & Glow Tracking) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        
        // 1. Glow Tracking Effect pada Cards
        const trackingCards = document.querySelectorAll('.tracking-card');
        
        trackingCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                // Menghitung posisi kursor relatif terhadap kartu
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                // Meneruskan variabel posisi ke CSS
                card.style.setProperty('--x', `${x}px`);
                card.style.setProperty('--y', `${y}px`);
            });
        });

        // 2. Magnetic Button Effect (Tombol tertarik oleh kursor)
        const magneticBtns = document.querySelectorAll('.magnetic-btn');
        
        magneticBtns.forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const position = btn.getBoundingClientRect();
                const x = e.pageX - position.left - position.width / 2;
                const y = e.pageY - position.top - position.height / 2;
                
                // Menggerakkan tombol sedikit ke arah kursor
                btn.style.transform = `translate(${x * 0.3}px, ${y * 0.5}px)`;
                
                // Menggerakkan teks di dalamnya sedikit lebih jauh untuk efek parallax
                const text = btn.querySelector('span');
                if(text) text.style.transform = `translate(${x * 0.2}px, ${y * 0.3}px)`;
            });

            btn.addEventListener('mouseleave', () => {
                // Kembalikan posisi ke awal dengan animasi transisi
                btn.style.transform = 'translate(0px, 0px)';
                const text = btn.querySelector('span');
                if(text) text.style.transform = 'translate(0px, 0px)';
                
                btn.style.transition = 'transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1)';
                if(text) text.style.transition = 'transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1)';
            });
            
            btn.addEventListener('mouseenter', () => {
                // Matikan transisi saat kursor berada di dalam agar gerakan responsif seketika
                btn.style.transition = 'none';
                const text = btn.querySelector('span');
                if(text) text.style.transition = 'none';
            });
        });
        
    });
</script>

@endsection