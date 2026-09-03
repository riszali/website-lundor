@extends('layouts.main')

@section('title', 'About Us - Esensee Imagine Digital')

@section('content')
<!-- Memanggil CSS Khusus About -->
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<!-- Menambahkan Google Fonts: Archivo Black (Heavy Brutalist), Syncopate (Tech/Wide), & Custom Font Altheria fallback -->
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Caveat:wght@600&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">

<style>
    /* Styling Font Altheria dengan Fallback Cursive */
    @font-face {
        font-family: 'Altheria';
        src: url('/assets/fonts/Altheria.ttf') format('truetype'),
             url('/assets/fonts/Altheria.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }
    
    .font-altheria {
        font-family: 'Altheria', 'Caveat', 'Dancing Script', cursive;
    }
    .font-archivo {
        font-family: 'Archivo Black', sans-serif;
    }
</style>

<!-- Custom Blade Macro / Inline Branding Badge ESENSEE -->
@php
    $logoInline = '<span class="inline-flex items-baseline font-black tracking-normal select-none">
        <span class="font-archivo text-white">ese</span>
        <span class="font-altheria italic text-[#f9005b] px-[1px] text-[1.1em] transform -translate-y-[1px]">n</span>
        <span class="font-archivo bg-clip-text text-transparent bg-gradient-to-r from-[#f9005b] via-[#ff528f] to-[#f9005b]">see</span>
    </span>';
@endphp

<!-- Wrapper Utama dengan Tema Super Gelap & Noise (dari CSS) -->
<div class="bg-[#030305] min-h-screen text-white overflow-hidden selection:bg-[#f9005b] selection:text-white relative">
    
    <!-- HUD Elements (Heads-Up Display) Kiri & Kanan -->
    <div class="hidden lg:block absolute left-6 top-1/2 -translate-y-1/2 -rotate-90 origin-left text-[10px] font-mono tracking-[0.5em] text-gray-600 z-50 pointer-events-none mix-blend-screen">
        SYS.CORE.V2 // ESENSEE_ARCHITECTURE
    </div>
    <div class="hidden lg:flex absolute right-6 top-1/3 flex-col gap-4 z-50 pointer-events-none">
        <span class="w-1 h-8 bg-gradient-to-b from-[#f9005b] to-transparent"></span>
        <span class="w-1 h-4 bg-white/20"></span>
        <span class="w-1 h-4 bg-white/20"></span>
    </div>

    <!-- ==========================================
         SECTION 1: HERO (REFINED SCALING)
         ========================================== -->
    <section class="relative w-full min-h-screen flex items-center pt-20 border-b border-white/5 overflow-hidden">
        
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 bg-[url('https://cards.scryfall.io/art_crop/front/b/b/bbd5c86a-0991-4322-a0a2-48424c4be2af.jpg?1721427902')] pointer-events-none opacity-30"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-[#f9005b]/5 to-transparent pointer-events-none"></div>

        <div class="relative z-10 w-full px-6 lg:px-12 gs-reveal max-w-[100rem] mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
            
            <!-- Kiri: Typography Raksasa & Agresif -->
            <div class="flex-1 w-full pt-10 lg:pt-0">
                <div class="flex items-center gap-4 mb-8">
                    <div class="relative flex items-center justify-center w-6 h-6">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-[#f9005b] opacity-75 animate-ping"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#f9005b]"></span>
                    </div>
                    <span class="text-[#f9005b] font-mono tracking-[0.4em] text-xs uppercase border-b border-[#f9005b]/30 pb-1">/// DNA_INITIALIZED</span>
                </div>
                
                <h1 class="text-[3.5rem] md:text-[5.5rem] lg:text-[7.5rem] font-black uppercase tracking-[-0.05em] leading-[0.9] mb-8 relative z-10 font-archivo">
                    <span class="block text-white">We Don't</span>
                    <span class="block text-transparent" style="-webkit-text-stroke: 1.5px rgba(255,255,255,0.3);">Follow</span>
                    <span class="block text-white">Trends.</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] via-[#9d00ff] to-[#f9005b] animate-gradient-xy mt-2">We Set Them.</span>
                </h1>

                <div class="flex flex-col sm:flex-row gap-8 mt-12 items-start sm:items-center">
                    <a href="#explore" class="group relative inline-flex items-center justify-center bg-transparent text-white font-mono text-sm px-8 py-4 overflow-hidden rounded-none transition-all hover:scale-105 border border-white/30">
                        <span class="absolute inset-0 w-full h-full bg-[#f9005b] transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                        <span class="relative z-10 group-hover:text-black font-bold uppercase tracking-widest transition-colors duration-300">Initiate Protocol</span>
                    </a>
                    <div class="text-xs font-mono text-gray-500 tracking-widest uppercase border-l border-white/20 pl-6 py-2">
                        Digital Agency <br> Born in Chaos
                    </div>
                </div>
            </div>

            <!-- Kanan: Asymmetric Tech Container -->
            <div class="flex-1 w-full relative h-[450px] lg:h-[700px] hidden md:flex items-center justify-center mt-12 lg:mt-0">
                
                <!-- Orbs Background Blur -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60%] h-[120%] bg-[#f9005b] rounded-full blur-[100px] opacity-20 mix-blend-screen animate-pulse"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[60%] bg-[#9d00ff] rounded-full blur-[100px] opacity-20 mix-blend-screen animate-pulse" style="animation-delay: 1.5s;"></div>
                
                <!-- 3D Glass Dashboard -->
                <div class="relative w-full max-w-lg aspect-square group">
                    <div class="absolute inset-0 border border-white/10 rounded-[30px] transform rotate-6 transition-transform duration-700 group-hover:rotate-12 group-hover:border-[#f9005b]/30"></div>
                    <div class="absolute inset-0 border border-white/10 rounded-[30px] transform -rotate-6 transition-transform duration-700 group-hover:-rotate-12 group-hover:border-[#9d00ff]/30"></div>
                    
                    <div class="absolute inset-0 backdrop-blur-xl bg-[#080815]/80 border border-white/10 rounded-[30px] shadow-2xl overflow-hidden flex flex-col">
                        <!-- Header Window -->
                        <div class="h-12 border-b border-white/10 flex items-center px-6 gap-3 bg-white/5">
                            <div class="w-3 h-3 rounded-full bg-[#f9005b]/60"></div>
                            <div class="w-3 h-3 rounded-full bg-[#9d00ff]/60"></div>
                            <div class="w-3 h-3 rounded-full bg-white/20"></div>
                            <div class="ml-auto text-[10px] font-mono text-gray-500 tracking-widest">ESENSEE_OS_v2.0</div>
                        </div>
                        
                        <!-- Konten Window -->
                        <div class="p-8 flex-1 flex flex-col justify-center relative">
                            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTAgMGgyMHYyMEgwdjIweiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIiBzdHJva2Utd2lkdGg9IjEiLz48L3N2Zz4=')] pointer-events-none opacity-50"></div>
                            
                            <div class="relative z-10">
                                <div class="text-[#f9005b] font-mono text-sm mb-4 animate-pulse">> RUN_DIAGNOSTIC</div>
                                <p class="text-gray-300 text-lg md:text-xl leading-relaxed font-light mb-8">
                                    {!! $logoInline !!} bukan sekadar agensi. Kami adalah <strong class="text-white">laboratorium eksperimental</strong> yang merancang antarmuka masa depan dengan estetika liar dan teknologi modern.
                                </p>
                                
                                <div class="space-y-4">
                                    <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-transparent to-[#f9005b] h-full w-[85%] relative">
                                            <div class="absolute top-0 right-0 bottom-0 w-4 bg-white/80 blur-[2px]"></div>
                                        </div>
                                    </div>
                                    <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-transparent to-[#9d00ff] h-full w-[92%] relative">
                                            <div class="absolute top-0 right-0 bottom-0 w-4 bg-white/80 blur-[2px]"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Scroll Indicator Down -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-20">
            <span class="text-[10px] font-mono text-gray-500 uppercase tracking-widest rotate-90 origin-center mb-8">Scroll</span>
            <div class="w-[1px] h-12 bg-white/10 relative overflow-hidden"></div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 2: FILOSOFI (OPTIMIZED FOR MOBILE)
         ========================================== -->
    <section class="py-20 lg:py-32 relative z-10 bg-[#020202] overflow-hidden">
        
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-b from-[#f9005b]/5 to-transparent pointer-events-none"></div>
        <div class="absolute top-1/2 left-0 w-full h-[1px] bg-white/5 pointer-events-none"></div>

        <div class="max-w-[100rem] mx-auto px-6 lg:px-12 relative z-10">
            
            <!-- --- PHASE 01: ESSENCE --- -->
            <div class="relative flex flex-col lg:flex-row items-center gap-10 lg:gap-24 mb-32 lg:mb-48">
                <div class="absolute -top-10 lg:-top-32 -left-5 lg:-left-10 text-[10rem] md:text-[20rem] lg:text-[25rem] font-black text-white/5 pointer-events-none select-none z-0" style="font-family: 'Impact'">01</div>
                
                <div class="lg:w-1/2 relative z-10 gs-reveal-right pt-16 lg:pt-10">
                    <div class="flex items-center gap-4 mb-6 lg:mb-8">
                        <span class="px-3 py-1 bg-[#f9005b]/10 text-[#f9005b] font-mono text-[10px] lg:text-xs tracking-[0.3em] border border-[#f9005b]/30">SYS.PHASE_01 // ESSENCE</span>
                        <div class="h-[1px] w-12 lg:w-16 bg-gradient-to-r from-[#f9005b] to-transparent"></div>
                    </div>
                    
                    <h2 class="text-5xl md:text-8xl lg:text-[7rem] font-black text-white mb-8 lg:mb-10 uppercase tracking-tighter leading-none lg:leading-[0.85] font-archivo">
                        Essence <br>
                        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #f9005b;">The Core Logic.</span>
                    </h2>
                    
                    <div class="pl-5 lg:pl-6 border-l-2 border-[#f9005b]/40 mb-10 space-y-6">
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Sebelum sebaris kode ditulis atau piksel digambar, kami di {!! $logoInline !!} selalu mencari <strong class="text-white">inti paling mendasar (Essence)</strong> dari masalah atau pesan produk Anda.
                        </p>
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Esensi disimbolkan oleh <strong class="font-archivo text-white">"ese"</strong> — struktur tebal Archivo Black yang kokoh, presisi, dan transparan.
                        </p>
                    </div>
                    
                    <div class="backdrop-blur-xl bg-black/40 border border-white/10 p-6 md:p-8 rounded-tr-2xl lg:rounded-tr-3xl rounded-bl-2xl lg:rounded-bl-3xl shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-1 h-full bg-[#f9005b]"></div>
                        <div class="absolute bottom-0 right-0 w-12 lg:w-16 h-12 lg:h-16 border-b border-r border-[#f9005b]/30"></div>
                        <p class="text-white/90 font-mono text-xs md:text-base leading-relaxed tracking-wide">
                            "We don't build features for noise. We build solutions anchored in pure core purpose."
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative z-10 gs-reveal-left mt-8 lg:mt-0">
                    <div class="relative w-full aspect-[4/5] sm:aspect-video lg:aspect-square">
                        <div class="absolute top-6 lg:top-10 -right-4 lg:-right-10 w-full h-full border border-white/5 bg-[#0a0a0f] rounded-2xl lg:rounded-3xl -z-10"></div>
                        <div class="absolute -bottom-6 lg:-bottom-10 -left-4 lg:-left-10 w-full h-full border border-[#f9005b]/20 bg-transparent rounded-2xl lg:rounded-3xl -z-10 transform -rotate-3 lg:-rotate-6"></div>
                        
                        <div class="w-full h-full overflow-hidden rounded-2xl lg:rounded-3xl relative">
                            <img src="https://cards.scryfall.io/art_crop/front/2/b/2b85a552-2119-4d9c-b7c1-c09c2d9f2f38.jpg?1594736130" alt="Essence Foundation" class="w-full h-full object-cover opacity-70 mix-blend-luminosity hover:mix-blend-normal hover:opacity-100 transition-all duration-700 hover:scale-105">
                        </div>

                        <div class="absolute -left-4 lg:-left-6 top-1/2 -translate-y-1/2 bg-[#f9005b] text-black font-mono font-bold text-[8px] lg:text-[10px] tracking-widest uppercase p-2 lg:p-3 transform -rotate-90 origin-left">
                            [ ARCHITECTING_ESSENCE ]
                        </div>
                    </div>
                </div>
            </div>

            <!-- --- PHASE 02: SENSE --- -->
            <div class="relative flex flex-col lg:flex-row-reverse items-center gap-10 lg:gap-24 mb-32 lg:mb-48">
                <div class="absolute -top-10 lg:-top-32 -right-5 lg:-right-10 text-[10rem] md:text-[20rem] lg:text-[25rem] font-black text-white/5 pointer-events-none select-none z-0 text-right" style="font-family: 'Impact'">02</div>

                <div class="lg:w-1/2 relative z-10 gs-reveal-left pt-16 lg:pt-10">
                    <div class="flex items-center justify-start lg:justify-end gap-4 mb-6 lg:mb-8">
                        <div class="hidden lg:block h-[1px] w-16 bg-gradient-to-l from-[#9d00ff] to-transparent"></div>
                        <span class="px-3 py-1 bg-[#9d00ff]/10 text-[#9d00ff] font-mono text-[10px] lg:text-xs tracking-[0.3em] border border-[#9d00ff]/30">SYS.PHASE_02 // SENSE</span>
                        <div class="lg:hidden h-[1px] w-12 bg-gradient-to-r from-[#9d00ff] to-transparent"></div>
                    </div>
                    
                    <h2 class="text-5xl md:text-8xl lg:text-[7rem] font-black text-white mb-8 lg:mb-10 uppercase tracking-tighter leading-none lg:leading-[0.85] text-left lg:text-right font-archivo">
                        Sense <br>
                        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #9d00ff;">Human Intuition.</span>
                    </h2>
                    
                    <div class="pr-0 lg:pr-6 border-l-2 lg:border-l-0 lg:border-r-2 border-[#9d00ff]/40 pl-5 lg:pl-0 mb-10 space-y-6 text-left lg:text-right">
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Produk digital yang sukses bukan cuma tentang kode yang berjalan, tapi tentang apa yang <strong class="text-white">dirasakan (Sense)</strong> saat audiens berinteraksi dengannya.
                        </p>
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Disimbolkan oleh karakter <strong class="font-altheria text-[#f9005b] text-2xl not-italic">"n"</strong> dengan font kaligrafi <strong class="text-white">Altheria</strong> — membawa kehangatan empati manusia di tengah kaku dan dinginnya sistem.
                        </p>
                    </div>
                    
                    <div class="backdrop-blur-xl bg-black/40 border border-white/10 p-6 md:p-8 rounded-tl-2xl lg:rounded-tl-3xl rounded-br-2xl lg:rounded-br-3xl shadow-2xl relative overflow-hidden group lg:ml-auto lg:w-5/6 text-left lg:text-right">
                        <div class="absolute top-0 right-0 w-1 h-full bg-[#9d00ff]"></div>
                        <div class="absolute bottom-0 left-0 w-12 lg:w-16 h-12 lg:h-16 border-b border-l border-[#9d00ff]/30"></div>
                        <p class="text-white/90 font-mono text-xs md:text-base leading-relaxed tracking-wide">
                            "Technology is invisible when the experience is seamless and deeply human."
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative z-10 gs-reveal-right mt-8 lg:mt-0">
                    <div class="relative w-full aspect-[4/5] sm:aspect-video lg:aspect-square">
                        <div class="absolute top-6 lg:top-10 -left-4 lg:-left-10 w-full h-full border border-white/5 bg-[#0a0a0f] rounded-2xl lg:rounded-3xl -z-10"></div>
                        <div class="absolute -bottom-6 lg:-bottom-10 -right-4 lg:-right-10 w-full h-full border border-[#9d00ff]/20 bg-transparent rounded-2xl lg:rounded-3xl -z-10 transform rotate-3 lg:rotate-6"></div>
                        
                        <div class="w-full h-full overflow-hidden rounded-2xl lg:rounded-3xl relative">
                            <img src="https://cards.scryfall.io/art_crop/front/a/b/abdd053f-87ea-4cc8-b3df-a0c69c798d57.jpg?1678736299" alt="Human Sense UX" class="w-full h-full object-cover opacity-70 mix-blend-luminosity hover:mix-blend-normal hover:opacity-100 transition-all duration-700 hover:scale-105">
                        </div>

                        <div class="absolute -right-4 lg:-right-6 top-1/2 -translate-y-1/2 bg-[#9d00ff] text-black font-mono font-bold text-[8px] lg:text-[10px] tracking-widest uppercase p-2 lg:p-3 transform rotate-90 origin-right">
                            [ ENGINEERING_SENSE ]
                        </div>
                    </div>
                </div>
            </div>

            <!-- --- PHASE 03: SEE --- -->
            <div class="relative flex flex-col lg:flex-row items-center gap-10 lg:gap-24">
                <div class="absolute -top-10 lg:-top-32 -left-5 lg:-left-10 text-[10rem] md:text-[20rem] lg:text-[25rem] font-black text-white/5 pointer-events-none select-none z-0" style="font-family: 'Impact'">03</div>
                
                <div class="lg:w-1/2 relative z-10 gs-reveal-right pt-16 lg:pt-10">
                    <div class="flex items-center gap-4 mb-6 lg:mb-8">
                        <span class="px-3 py-1 bg-cyan-500/10 text-cyan-400 font-mono text-[10px] lg:text-xs tracking-[0.3em] border border-cyan-500/30">SYS.PHASE_03 // SEE</span>
                        <div class="h-[1px] w-12 lg:w-16 bg-gradient-to-r from-cyan-400 to-transparent"></div>
                    </div>
                    
                    <h2 class="text-5xl md:text-8xl lg:text-[7rem] font-black text-white mb-8 lg:mb-10 uppercase tracking-tighter leading-none lg:leading-[0.85] font-archivo">
                        See <br>
                        <span class="text-transparent" style="-webkit-text-stroke: 1.5px #00f0ff;">Visible Execution.</span>
                    </h2>
                    
                    <div class="pl-5 lg:pl-6 border-l-2 border-cyan-500/40 mb-10 space-y-6">
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Peran kami adalah mentransformasikan gagasan abstrak menjadi kenyataan visual yang <strong class="text-white">jelas terlihat (See)</strong>.
                        </p>
                        <p class="text-gray-400 text-base lg:text-xl leading-relaxed font-light">
                            Representasi <strong class="font-archivo text-[#f9005b]">"see"</strong> dengan font Archivo Black bertabur gradasi pink melambangkan keberanian estetika dan hasil eksekusi yang tak terbantahkan.
                        </p>
                    </div>
                    
                    <div class="backdrop-blur-xl bg-black/40 border border-white/10 p-6 md:p-8 rounded-tr-2xl lg:rounded-tr-3xl rounded-bl-2xl lg:rounded-bl-3xl shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-1 h-full bg-cyan-400"></div>
                        <div class="absolute bottom-0 right-0 w-12 lg:w-16 h-12 lg:h-16 border-b border-r border-cyan-400/30"></div>
                        <p class="text-white/90 font-mono text-xs md:text-base leading-relaxed tracking-wide">
                            "We turn raw logic and abstract thoughts into things you can see, touch, and remember."
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative z-10 gs-reveal-left mt-8 lg:mt-0">
                    <div class="relative w-full aspect-[4/5] sm:aspect-video lg:aspect-square">
                        <div class="absolute top-6 lg:top-10 -right-4 lg:-right-10 w-full h-full border border-white/5 bg-[#0a0a0f] rounded-2xl lg:rounded-3xl -z-10"></div>
                        <div class="absolute -bottom-6 lg:-bottom-10 -left-4 lg:-left-10 w-full h-full border border-cyan-400/20 bg-transparent rounded-2xl lg:rounded-3xl -z-10 transform -rotate-3 lg:-rotate-6"></div>
                        
                        <div class="w-full h-full overflow-hidden rounded-2xl lg:rounded-3xl relative">
                            <img src="https://cards.scryfall.io/art_crop/front/b/b/bbd5c86a-0991-4322-a0a2-48424c4be2af.jpg?1721427902" alt="Visible Execution" class="w-full h-full object-cover opacity-70 mix-blend-luminosity hover:mix-blend-normal hover:opacity-100 transition-all duration-700 hover:scale-105">
                        </div>

                        <div class="absolute -left-4 lg:-left-6 top-1/2 -translate-y-1/2 bg-cyan-400 text-black font-mono font-bold text-[8px] lg:text-[10px] tracking-widest uppercase p-2 lg:p-3 transform -rotate-90 origin-left">
                            [ VISUALIZING_EXCELLENCE ]
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ==========================================
         SECTION 2.5: LOGO PHILOSOPHY (THE ANATOMY)
         ========================================== -->
    <section class="py-24 relative z-10 bg-[#060609] border-t border-white/5 overflow-hidden">
        
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTU5IDYwaDFWMEgwdjFoNTl6IiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] pointer-events-none opacity-50"></div>
        
        <div class="max-w-[100rem] mx-auto px-6 lg:px-12 relative z-10">
            
            <div class="flex flex-col items-center mb-20 gs-reveal-up">
                <div class="flex items-center gap-4 mb-4">
                    <span class="w-8 h-[1px] bg-gradient-to-r from-transparent to-[#f9005b]"></span>
                    <span class="text-[#f9005b] font-mono text-[10px] tracking-[0.4em] uppercase border border-[#f9005b]/30 px-3 py-1 bg-[#f9005b]/5">SYS.LOGO_ANATOMY</span>
                    <span class="w-8 h-[1px] bg-gradient-to-l from-transparent to-[#f9005b]"></span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white uppercase tracking-tighter text-center font-archivo">
                    The Identity of <br/> {!! $logoInline !!}
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left: Logo Display (Asset Path Updated) -->
                <div class="lg:col-span-5 relative flex justify-center items-center gs-reveal-right">
                    <div class="absolute bottom-0 w-64 h-8 bg-[#f9005b]/20 blur-xl rounded-[100%]"></div>
                    <div class="absolute bottom-4 w-48 h-1 bg-gradient-to-r from-transparent via-[#f9005b] to-transparent"></div>
                    
                    <div class="relative w-full max-w-[400px] aspect-square border border-white/10 bg-black/40 backdrop-blur-sm p-8 flex items-center justify-center group rounded-xl overflow-hidden">
                        <!-- Corner Brackets -->
                        <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-[#f9005b] transition-all group-hover:w-12 group-hover:h-12"></div>
                        <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-[#f9005b] transition-all group-hover:w-12 group-hover:h-12"></div>
                        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-[#f9005b] transition-all group-hover:w-12 group-hover:h-12"></div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-[#f9005b] transition-all group-hover:w-12 group-hover:h-12"></div>

                        <!-- Gambar Logo yang Diperbarui sesuai path lokal -->
                        <img src="{{ asset('assets/images/logo-client/esensee.png') }}" alt="Esensee Logo" class="w-full h-auto max-h-[220px] object-contain relative z-10 drop-shadow-[0_0_20px_rgba(249,0,91,0.25)] transition-transform duration-700 group-hover:scale-105">
                    </div>
                </div>

                <!-- Right: Typography Breakdown -->
                <div class="lg:col-span-7 space-y-8 gs-reveal-left">
                    
                    <!-- Point 1: ese -->
                    <div class="flex gap-6 group">
                        <div class="flex-shrink-0 mt-2">
                            <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center bg-white/5 text-white font-archivo text-xs group-hover:border-white transition-colors">ese</div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2 tracking-wide uppercase font-archivo">
                                "ese" — Archivo Black (Essence & Logic)
                            </h3>
                            <p class="text-gray-400 leading-relaxed font-light text-base lg:text-lg">
                                Menggunakan font <strong class="text-white font-mono">Archivo Black</strong> dengan warna putih solid. Melambangkan kejelasan berpikir, fondasi logika yang kokoh, serta struktur teknologi yang transparan dan presisi.
                            </p>
                        </div>
                    </div>

                    <div class="w-full h-[1px] bg-gradient-to-r from-white/10 to-transparent my-6"></div>

                    <!-- Point 2: n -->
                    <div class="flex gap-6 group">
                        <div class="flex-shrink-0 mt-2">
                            <div class="w-12 h-12 rounded-full border border-[#f9005b]/40 flex items-center justify-center bg-[#f9005b]/10 text-[#f9005b] font-altheria text-xl group-hover:border-[#f9005b] group-hover:bg-[#f9005b]/20 transition-all shadow-[0_0_15px_rgba(249,0,91,0.2)]">n</div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#f9005b] mb-2 tracking-wide uppercase font-archivo">
                                "n" — Altheria Script (Human Sense)
                            </h3>
                            <p class="text-gray-400 leading-relaxed font-light text-base lg:text-lg">
                                Dibuat dengan gaya kaligrafi melengkung menggunakan font <strong class="text-[#f9005b] font-mono">Altheria</strong>. Menghadirkan sentuhan emosi, intuisi, empati desain, serta *User Experience* yang humanis di tengah teknologi.
                            </p>
                        </div>
                    </div>

                    <div class="w-full h-[1px] bg-gradient-to-r from-[#f9005b]/20 to-transparent my-6"></div>

                    <!-- Point 3: see -->
                    <div class="flex gap-6 group">
                        <div class="flex-shrink-0 mt-2">
                            <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center bg-white/5 text-[#f9005b] font-archivo text-xs group-hover:border-white transition-colors">see</div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2 tracking-wide uppercase font-archivo">
                                "see" — Archivo Black Pink Gradient (Visual Execution)
                            </h3>
                            <p class="text-gray-400 leading-relaxed font-light text-base lg:text-lg">
                                Kembali ke ketegasan font <strong class="text-white font-mono">Archivo Black</strong> yang dibalut warna gradasi merah muda hangat. Melambangkan visi estetika, keberanian kreasional, dan hasil eksekusi visual (*gold standard*).
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 3: STATS & FOOTPRINTS
         ========================================== -->
    <section class="py-20 lg:py-24 bg-[#030305] relative overflow-hidden border-t border-white/5">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-2xl h-[1px] bg-gradient-to-r from-transparent via-[#f9005b]/50 to-transparent"></div>
        
        <div class="max-w-[100rem] mx-auto px-6 lg:px-12 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 lg:mb-16 gs-reveal-up">
                <div>
                    <span class="text-gray-500 font-mono text-[10px] tracking-[0.3em] uppercase block mb-2">/// Database Readout</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter font-archivo">Our Footprints</h2>
                </div>
                <div class="hidden md:block w-32 h-[1px] bg-white/20"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-10 md:gap-8 text-left">
                <div class="stat-box gs-reveal-up border-l-2 border-l-[#f9005b] pl-4">
                    <div class="flex justify-between items-start mb-3 lg:mb-4">
                        <span class="text-white/30 font-mono text-[10px]">DT_01</span>
                        <svg class="w-3 h-3 lg:w-4 lg:h-4 text-[#f9005b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-1 lg:mb-2 counter" data-target="150">0</h3>
                    <p class="text-gray-400 font-mono text-[8px] lg:text-xs uppercase tracking-[0.15em] lg:tracking-widest">Projects Shipped</p>
                </div>
                
                <div class="stat-box gs-reveal-up delay-100 border-l-2 border-l-[#9d00ff] pl-4">
                    <div class="flex justify-between items-start mb-3 lg:mb-4">
                        <span class="text-white/30 font-mono text-[10px]">DT_02</span>
                        <svg class="w-3 h-3 lg:w-4 lg:h-4 text-[#9d00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-1 lg:mb-2 counter" data-target="45">0</h3>
                    <p class="text-gray-400 font-mono text-[8px] lg:text-xs uppercase tracking-[0.15em] lg:tracking-widest">Global Clients</p>
                </div>
                
                <div class="stat-box gs-reveal-up delay-200 border-l-2 border-l-white pl-4">
                    <div class="flex justify-between items-start mb-3 lg:mb-4">
                        <span class="text-white/30 font-mono text-[10px]">DT_03</span>
                        <svg class="w-3 h-3 lg:w-4 lg:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-1 lg:mb-2 counter" data-target="12">0</h3>
                    <p class="text-gray-400 font-mono text-[8px] lg:text-xs uppercase tracking-[0.15em] lg:tracking-widest">Awards Won</p>
                </div>
                
                <div class="stat-box gs-reveal-up delay-300 border-l-2 border-l-gray-600 pl-4">
                    <div class="flex justify-between items-start mb-3 lg:mb-4">
                        <span class="text-white/30 font-mono text-[10px]">DT_04</span>
                        <svg class="w-3 h-3 lg:w-4 lg:h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-1 lg:mb-2 counter" data-target="999">0</h3>
                    <p class="text-gray-500 font-mono text-[8px] lg:text-xs uppercase tracking-[0.15em] lg:tracking-widest">Coffee Cups</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 4: OUR TEAM
         ========================================== -->
    <section class="relative py-32 bg-[#020202] overflow-hidden border-t border-white/5 min-h-[80vh] flex items-center">
        <div id="threejs-container" class="absolute inset-0 z-0 w-full h-full opacity-60"></div>
        <div class="absolute inset-0 z-0 bg-gradient-to-t from-[#020202] via-transparent to-[#020202] pointer-events-none"></div>

        <div class="max-w-[100rem] mx-auto px-6 lg:px-12 relative z-10 w-full">
            <div class="flex flex-col items-center mb-24 gs-reveal-up pointer-events-none">
                <div class="flex items-center gap-4 mb-4">
                    <span class="w-8 h-[1px] bg-gradient-to-r from-transparent to-[#9d00ff]"></span>
                    <span class="text-[#9d00ff] font-mono text-[10px] tracking-[0.4em] uppercase border border-[#9d00ff]/30 px-3 py-1 bg-[#9d00ff]/5">SYS.HUMAN_RESOURCES</span>
                    <span class="w-8 h-[1px] bg-gradient-to-l from-transparent to-[#9d00ff]"></span>
                </div>
                <h2 class="text-5xl md:text-6xl lg:text-[5rem] font-black text-white uppercase tracking-tighter text-center leading-none font-archivo">
                    The <span class="text-transparent" style="-webkit-text-stroke: 1.5px #9d00ff;">Architects</span>
                </h2>
                <p class="text-gray-400 mt-6 max-w-xl text-center font-light font-mono text-xs tracking-widest uppercase">
                    Pikiran di balik kode. Manusia di balik mesin.
                </p>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8 relative z-10">
                
                <!-- Team Member 1 -->
                <div class="group relative bg-[#0a0a0f]/80 backdrop-blur-md border border-white/10 p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 gs-reveal-up">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#f9005b] to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#111]">
                        <img src="{{ asset('assets/images/rifki.jpeg') }}" alt="Muhammad Rifki" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:filter-none group-hover:opacity-100 transition-all duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-5 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tight mb-1 font-archivo">Muhammad Rifki</h3>
                            <p class="text-[#f9005b] font-mono text-[10px] lg:text-xs tracking-widest uppercase">Visionary / CEO</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="group relative bg-[#0a0a0f]/80 backdrop-blur-md border border-white/10 p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 gs-reveal-up delay-100 lg:mt-6">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#9d00ff] to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#111]">
                        <img src="{{ asset('assets/images/vira.jpeg') }}" alt="Vira vena" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:filter-none group-hover:opacity-100 transition-all duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-5 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tight mb-1 font-archivo">Vira vena</h3>
                            <p class="text-[#9d00ff] font-mono text-[10px] lg:text-xs tracking-widest uppercase">Creative Director</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="group relative bg-[#0a0a0f]/80 backdrop-blur-md border border-white/10 p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 gs-reveal-up delay-200">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#111]">
                        <img src="{{ asset('assets/images/IMG_004922.jpg') }}" alt="Risz Ali" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:filter-none group-hover:opacity-100 transition-all duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-5 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tight mb-1 font-archivo">Risz Ali</h3>
                            <p class="text-white/60 font-mono text-[10px] lg:text-xs tracking-widest uppercase">Lead Technologist</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="group relative bg-[#0a0a0f]/80 backdrop-blur-md border border-white/10 p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 gs-reveal-up delay-300 lg:mt-6">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#f9005b] to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#111]">
                        <img src="{{ asset('assets/images/marsel.jpg') }}" alt="Marcel Reynold" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:filter-none group-hover:opacity-100 transition-all duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-5 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tight mb-1 font-archivo">Marcel Reynold</h3>
                            <p class="text-[#f9005b] font-mono text-[10px] lg:text-xs tracking-widest uppercase">UI/UX Architect</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="group relative bg-[#0a0a0f]/80 backdrop-blur-md border border-white/10 p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 gs-reveal-up delay-300 xl:mt-6">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#111]">
                        <img src="{{ asset('assets/images/2026-03-19 202739.png') }}" alt="Faisal K" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:filter-none group-hover:opacity-100 transition-all duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-5 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tight mb-1 font-archivo">Faisal K</h3>
                            <p class="text-white/60 font-mono text-[10px] lg:text-xs tracking-widest uppercase">Project Manager</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="{{ asset('js/about.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('threejs-container');
        if (!container) return;

        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(0x020202, 0.001);

        const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
        camera.position.z = 30;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        const objectGroup = new THREE.Group();
        scene.add(objectGroup);

        const icosahedronGeo = new THREE.IcosahedronGeometry(20, 1);
        const icosahedronMat = new THREE.MeshBasicMaterial({ 
            color: 0xf9005b, 
            wireframe: true,
            transparent: true,
            opacity: 0.15
        });
        const icosahedron = new THREE.Mesh(icosahedronGeo, icosahedronMat);
        objectGroup.add(icosahedron);

        const torusGeo = new THREE.TorusKnotGeometry(10, 3, 100, 16);
        const torusMat = new THREE.MeshBasicMaterial({ 
            color: 0x9d00ff, 
            wireframe: true,
            transparent: true,
            opacity: 0.1
        });
        const torus = new THREE.Mesh(torusGeo, torusMat);
        objectGroup.add(torus);

        const particlesGeo = new THREE.BufferGeometry();
        const particlesCount = 700;
        const posArray = new Float32Array(particlesCount * 3);

        for(let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 100;
        }

        particlesGeo.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particlesMat = new THREE.PointsMaterial({
            size: 0.15,
            color: 0xffffff,
            transparent: true,
            opacity: 0.5,
            blending: THREE.AdditiveBlending
        });

        const particlesMesh = new THREE.Points(particlesGeo, particlesMat);
        scene.add(particlesMesh);

        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX);
            mouseY = (event.clientY - windowHalfY);
        });

        const clock = new THREE.Clock();

        function animate() {
            requestAnimationFrame(animate);
            const elapsedTime = clock.getElapsedTime();

            icosahedron.rotation.x += 0.001;
            icosahedron.rotation.y += 0.002;
            
            torus.rotation.x -= 0.002;
            torus.rotation.y -= 0.001;

            particlesMesh.rotation.y = -elapsedTime * 0.05;

            targetX = mouseX * 0.001;
            targetY = mouseY * 0.001;
            
            objectGroup.rotation.y += 0.05 * (targetX - objectGroup.rotation.y);
            objectGroup.rotation.x += 0.05 * (targetY - objectGroup.rotation.x);

            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener('resize', () => {
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        });
    });
</script>
@endsection