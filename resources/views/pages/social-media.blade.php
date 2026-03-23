@extends('layouts.main')

@section('title', 'Social Media Management - Lund\'or Imagine Digital')

@section('content')
<!-- Font Khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<!-- CSS Khusus Halaman Ini -->
<style>
    .font-space {
        font-family: 'Space Grotesk', sans-serif;
    }
    
    .text-stroke {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.2);
    }
    .text-stroke-hover:hover {
        color: #f9005b;
        -webkit-text-stroke: 1px #f9005b;
        text-shadow: 0 0 20px rgba(249,0,91,0.5);
    }

    /* Efek Grid Latar Belakang */
    .bg-grid-cyber {
        background-size: 40px 40px;
        background-image: 
            linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
    }

    /* Kartu Glow */
    .glow-card {
        background: rgba(10, 10, 20, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.4s ease;
    }
    .glow-card:hover {
        border-color: rgba(249, 0, 91, 0.5);
        box-shadow: 0 10px 40px -10px rgba(249, 0, 91, 0.3);
        transform: translateY(-5px);
    }

    /* Animasi Timeline */
    .timeline-line {
        background: linear-gradient(to bottom, #f9005b, #9d00ff);
    }

    /* Canvas 3D Hero */
    #network-canvas {
        pointer-events: auto; /* Memungkinkan interaksi mouse pada 3D */
    }
</style>

<!-- 1. HERO SECTION DENGAN 3D NETWORK ALGORITHM -->
<section class="relative w-full min-h-[90vh] bg-[#080815] flex flex-col items-center justify-center overflow-hidden bg-grid-cyber pt-24 pb-12">
    <!-- Kontainer Three.js -->
    <div id="network-canvas" class="absolute inset-0 z-0"></div>

    <!-- Ornamen Glow (Tetap dipertahankan untuk blending warna) -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#f9005b]/10 rounded-full blur-[150px] pointer-events-none z-0"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#9d00ff]/10 rounded-full blur-[150px] pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center pointer-events-none">
        <div class="inline-block bg-[#080815]/50 border border-white/10 rounded-full px-6 py-2 mb-8 backdrop-blur-md">
            <span class="text-[#f9005b] font-mono text-sm tracking-widest uppercase font-bold animate-pulse">System Overload // SMM Module</span>
        </div>
        
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter mb-6 font-space leading-none drop-shadow-2xl">
            Hijack The <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Algorithm</span>
        </h1>
        
        <p class="text-gray-400 text-lg md:text-2xl max-w-3xl mx-auto font-space leading-relaxed mb-12 backdrop-blur-sm bg-black/20 p-4 rounded-xl border border-white/5">
            Social Media bukan sekadar tentang memposting desain yang cantik. Ini tentang mencuri perhatian, mendominasi timeline, dan mengubah audiens pasif menjadi sekte (cult) untuk brand Anda.
        </p>

        <a href="#problem-section" class="inline-flex items-center gap-3 text-white font-mono uppercase tracking-widest text-sm hover:text-[#f9005b] transition-colors cursor-pointer group pointer-events-auto bg-[#0a0a14] px-8 py-3 rounded-full border border-white/10">
            Scroll to uncover the truth
            <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </a>
    </div>
</section>

<!-- 2. THE PROBLEM (Mengapa Brand Gagal) -->
<section id="problem-section" class="py-24 bg-black relative border-t border-white/10 z-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Teks Problem -->
            <div>
                <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-6 font-space">
                    The Digital <br><span class="text-stroke">Nightmare.</span>
                </h2>
                <div class="space-y-8">
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-500 font-bold font-mono">01</div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Terjebak di Zona "Ghost Town"</h3>
                            <p class="text-gray-400 leading-relaxed">Anda memposting konten setiap hari, desainnya rapi, captionnya panjang... tapi tidak ada yang peduli. Nol komentar, like sepi, dan insight mati. Brand Anda seolah berteriak di ruang hampa.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-500 font-bold font-mono">02</div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Budak Tren Tanpa Identitas</h3>
                            <p class="text-gray-400 leading-relaxed">Sekadar ikut-ikutan tren joget TikTok atau audio viral tanpa menyesuaikan dengan DNA brand. Hasilnya? Views mungkin naik sesaat, tapi tidak ada konversi atau loyalitas jangka panjang.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-500 font-bold font-mono">03</div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Tidak Ada Data, Hanya Feeling</h3>
                            <p class="text-gray-400 leading-relaxed">Menghabiskan budget untuk produksi konten tapi tidak pernah menganalisis metrik apa yang benar-benar mendatangkan leads. Bergerak buta tanpa peta strategi yang jelas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Problem (Abstract/Brutalism UI) -->
            <div class="relative h-[500px] bg-[#0a0a14] rounded-3xl border border-white/5 overflow-hidden group">
                <div class="absolute inset-0 bg-red-500/5 mix-blend-overlay"></div>
                <!-- Mockup/Data Chart Simulation -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] flex flex-col gap-4">
                    <div class="w-full bg-black border border-white/10 p-4 rounded-xl shadow-2xl transform -rotate-2 group-hover:rotate-0 transition-transform duration-500">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs text-gray-500 font-mono">Engagement Rate</span>
                            <span class="text-xs text-red-500 font-bold">-84% 📉</span>
                        </div>
                        <div class="w-full h-2 bg-gray-900 rounded-full overflow-hidden">
                            <div class="w-[10%] h-full bg-red-500"></div>
                        </div>
                    </div>
                    <div class="w-full bg-black border border-white/10 p-4 rounded-xl shadow-2xl transform rotate-3 group-hover:rotate-0 transition-transform duration-500 delay-75">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs text-gray-500 font-mono">Followers Growth</span>
                            <span class="text-xs text-red-500 font-bold">Stagnant</span>
                        </div>
                        <div class="w-full h-12 border-b border-l border-white/10 flex items-end gap-2 px-2 pb-1">
                            <!-- Bar chart bars -->
                            <div class="w-full h-[20%] bg-white/5"></div>
                            <div class="w-full h-[15%] bg-white/5"></div>
                            <div class="w-full h-[25%] bg-white/5"></div>
                            <div class="w-full h-[10%] bg-red-500/50"></div>
                            <div class="w-full h-[5%] bg-red-500/80"></div>
                        </div>
                    </div>
                    <div class="absolute -bottom-12 -right-12 text-[#f9005b] font-black text-6xl opacity-20 transform rotate-12 uppercase tracking-tighter">Boring</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. THE WORK PROCESS (Bagaimana Kita Menyelesaikannya) -->
<section class="py-24 bg-[#05050a] relative z-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 font-space">
                The <span class="text-[#f9005b]">Blueprint.</span>
            </h2>
            <p class="text-gray-400 font-mono text-sm uppercase tracking-widest">Metodologi anti-mainstream kami untuk mendominasi timeline.</p>
        </div>

        <!-- Vertical Timeline Layout -->
        <div class="relative max-w-4xl mx-auto">
            <!-- Garis Tengah -->
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 timeline-line md:-translate-x-1/2 opacity-30"></div>

            <!-- Step 1 -->
            <div class="relative flex flex-col md:flex-row items-center justify-between mb-16 md:mb-24 group">
                <div class="hidden md:block w-5/12 text-right pr-8">
                    <h3 class="text-2xl font-black text-white font-space mb-2">01. Deep Reconnaissance</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Kami tidak menebak. Kami membedah data analitik Anda saat ini, mengintip strategi kompetitor, dan memetakan pola perilaku audiens target Anda. Kami mencari celah (gap) yang bisa dieksploitasi.</p>
                </div>
                <!-- Titik Neon -->
                <div class="absolute left-8 md:left-1/2 w-6 h-6 bg-black border-4 border-[#f9005b] rounded-full transform -translate-x-1/2 shadow-[0_0_20px_#f9005b] group-hover:scale-150 transition-transform z-10"></div>
                
                <div class="w-full md:w-5/12 pl-20 md:pl-8 text-left glow-card p-6 rounded-2xl">
                    <div class="md:hidden mb-4">
                        <h3 class="text-xl font-black text-white font-space mb-2">01. Deep Recon</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Audit total sosial media, analisis kompetitor, dan pencarian audiens tersembunyi.</p>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white font-mono">Brand Audit</span>
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white font-mono">Competitor Analysis</span>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative flex flex-col md:flex-row items-center justify-between mb-16 md:mb-24 group">
                <div class="w-full md:w-5/12 pl-20 md:pl-0 md:pr-8 md:text-right glow-card p-6 rounded-2xl order-2 md:order-1">
                    <div class="md:hidden mb-4">
                        <h3 class="text-xl font-black text-white font-space mb-2">02. Chaos Strategy</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Pembuatan Content Pillar, Tone of Voice, dan strategi distribusi yang unik.</p>
                    </div>
                    <div class="flex gap-2 flex-wrap md:justify-end">
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white font-mono">Content Pillar</span>
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white font-mono">Copywriting Guideline</span>
                    </div>
                </div>
                <!-- Titik Neon -->
                <div class="absolute left-8 md:left-1/2 w-6 h-6 bg-black border-4 border-[#bc13fe] rounded-full transform -translate-x-1/2 shadow-[0_0_20px_#bc13fe] group-hover:scale-150 transition-transform z-10 order-1 md:order-2"></div>
                
                <div class="hidden md:block w-5/12 text-left pl-8 order-3">
                    <h3 class="text-2xl font-black text-white font-space mb-2">02. The Chaos Strategy</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Kami merancang <em>Content Pillar</em> dan <em>Tone of Voice</em>. Berhenti menjadi robot perusahaan. Kami membangun persona digital yang punya karakter, pendapat, dan gaya yang tidak bisa diabaikan.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative flex flex-col md:flex-row items-center justify-between mb-16 md:mb-24 group">
                <div class="hidden md:block w-5/12 text-right pr-8">
                    <h3 class="text-2xl font-black text-white font-space mb-2">03. High-Octane Production</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Dari desain feed statis bernuansa 3D/modern, hingga video Reels/TikTok dengan editing *fast-paced* yang menahan retensi penonton. Kualitas agensi kelas atas untuk setiap postingan.</p>
                </div>
                <!-- Titik Neon -->
                <div class="absolute left-8 md:left-1/2 w-6 h-6 bg-black border-4 border-[#f9005b] rounded-full transform -translate-x-1/2 shadow-[0_0_20px_#f9005b] group-hover:scale-150 transition-transform z-10"></div>
                
                <div class="w-full md:w-5/12 pl-20 md:pl-8 text-left glow-card p-6 rounded-2xl">
                    <div class="md:hidden mb-4">
                        <h3 class="text-xl font-black text-white font-space mb-2">03. Production</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Eksekusi desain grafis 3D/2D, video Reels/TikTok, dan copywriting tajam.</p>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-[#f9005b]/20 border border-[#f9005b]/30 rounded-full text-xs text-[#f9005b] font-mono">3D / 2D Assets</span>
                        <span class="px-3 py-1 bg-[#f9005b]/20 border border-[#f9005b]/30 rounded-full text-xs text-[#f9005b] font-mono">Short-form Video</span>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative flex flex-col md:flex-row items-center justify-between group">
                <div class="w-full md:w-5/12 pl-20 md:pl-0 md:pr-8 md:text-right glow-card p-6 rounded-2xl order-2 md:order-1">
                    <div class="md:hidden mb-4">
                        <h3 class="text-xl font-black text-white font-space mb-2">04. Data & Analytics</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Pelaporan bulanan, optimasi algoritma, dan manajemen komunitas yang aktif.</p>
                    </div>
                    <div class="flex gap-2 flex-wrap md:justify-end">
                        <span class="px-3 py-1 bg-[#9d00ff]/20 border border-[#9d00ff]/30 rounded-full text-xs text-[#9d00ff] font-mono">Community Mgt.</span>
                        <span class="px-3 py-1 bg-[#9d00ff]/20 border border-[#9d00ff]/30 rounded-full text-xs text-[#9d00ff] font-mono">Monthly Report</span>
                    </div>
                </div>
                <!-- Titik Neon -->
                <div class="absolute left-8 md:left-1/2 w-6 h-6 bg-black border-4 border-[#9d00ff] rounded-full transform -translate-x-1/2 shadow-[0_0_20px_#9d00ff] group-hover:scale-150 transition-transform z-10 order-1 md:order-2"></div>
                
                <div class="hidden md:block w-5/12 text-left pl-8 order-3">
                    <h3 class="text-2xl font-black text-white font-space mb-2">04. Community & Analytics</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Kami tidak membiarkan postingan mati. Kami membalas komentar, memancing interaksi, lalu mengukur semua metrik keberhasilan di akhir bulan untuk taktik bulan depan.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3.5 THE VISUALS (Content Production Gallery) -->
<section class="py-24 bg-[#080815] relative z-20 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16 text-center">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 font-space">
                Behind The <span class="text-[#f9005b]">Lens.</span>
            </h2>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto font-space">Kami tidak hanya bermain dengan kata-kata. Kami memproduksi visual kelas atas yang merepresentasikan brand Anda secara brutal namun elegan. Inilah realita di balik layar kami.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Image 1 -->
            <div class="md:col-span-8 h-[400px] md:h-[500px] rounded-3xl overflow-hidden group relative glow-card cursor-pointer gallery-item">
                <img src="{{ asset('assets/images/social-media/AZS02836.jpg') }}" alt="Social Media Production 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 gallery-img">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-4 border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500 shadow-[0_0_20px_rgba(249,0,91,0.5)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
            
            <!-- Image 2 -->
            <div class="md:col-span-4 h-[400px] md:h-[500px] rounded-3xl overflow-hidden group relative glow-card cursor-pointer gallery-item">
                <img src="{{ asset('assets/images/social-media/AZS02960.jpg') }}" alt="Social Media Production 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 gallery-img">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-4 border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500 shadow-[0_0_20px_rgba(157,0,255,0.5)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
            
            <!-- Image 3 -->
            <div class="md:col-span-4 h-[400px] rounded-3xl overflow-hidden group relative glow-card cursor-pointer gallery-item">
                <img src="{{ asset('assets/images/social-media/AZS03060.jpg') }}" alt="Social Media Production 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 gallery-img">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-4 border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500 shadow-[0_0_20px_rgba(249,0,91,0.5)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
            
            <!-- Image 4 -->
            <div class="md:col-span-4 h-[400px] rounded-3xl overflow-hidden group relative glow-card cursor-pointer gallery-item">
                <img src="{{ asset('assets/images/social-media/IMG_8191.JPG') }}" alt="Social Media Production 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 gallery-img">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-4 border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500 shadow-[0_0_20px_rgba(157,0,255,0.5)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
            
            <!-- Image 5 -->
            <div class="md:col-span-4 h-[400px] rounded-3xl overflow-hidden group relative glow-card cursor-pointer gallery-item">
                <img src="{{ asset('assets/images/social-media/P1360705.png') }}" alt="Social Media Production 5" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 gallery-img">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-4 border border-white/20 transform scale-50 group-hover:scale-100 transition-transform duration-500 shadow-[0_0_20px_rgba(249,0,91,0.5)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. THE OUTPUT (Apa yang didapat Client) -->
<!-- Menggunakan Bento Grid Layout -->
<section class="py-24 bg-[#0a0a14] relative z-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16">
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 font-space">
                The <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#9d00ff] to-[#f9005b]">Arsenal.</span>
            </h2>
            <p class="text-gray-400 text-lg max-w-2xl">Berhenti membuang uang tanpa hasil. Ini adalah aset, data, dan pertumbuhan nyata yang akan diserahkan ke tangan Anda setiap bulannya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Bento Box 1: Content Calendar (Besar) -->
            <div class="md:col-span-2 glow-card rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#f9005b]/10 rounded-full blur-[80px]"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#f9005b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-4 font-space">Actionable Content Calendar</h3>
                    <p class="text-gray-400 mb-6">Jadwal terstruktur selama 1 bulan penuh. Anda tahu persis konten apa yang akan naik, kapan naiknya, lengkap dengan preview desain dan <em>copywriting</em>. Anda memegang kendali penuh untuk <em>approve</em> sebelum ditayangkan.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-gray-300 font-mono"><span class="text-[#f9005b]">✔</span> Jadwal Post Harian/Mingguan</li>
                        <li class="flex items-center gap-3 text-sm text-gray-300 font-mono"><span class="text-[#f9005b]">✔</span> Hashtag & Keyword Strategy</li>
                        <li class="flex items-center gap-3 text-sm text-gray-300 font-mono"><span class="text-[#f9005b]">✔</span> Platform: IG, TikTok, LinkedIn, dll.</li>
                    </ul>
                </div>
            </div>

            <!-- Bento Box 2: Visual Assets -->
            <div class="glow-card rounded-3xl p-8 relative overflow-hidden group">
                <div class="relative z-10 h-full flex flex-col">
                    <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#9d00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-4 font-space">Premium Assets</h3>
                    <p class="text-gray-400 text-sm flex-grow">Aset desain grafis resolusi tinggi, infografis, korsel (carousel), dan video pendek dengan editing level agensi yang siap menaikkan wibawa brand Anda.</p>
                </div>
            </div>

            <!-- Bento Box 3: Organic Growth -->
            <div class="glow-card rounded-3xl p-8 relative overflow-hidden group">
                <div class="relative z-10 h-full flex flex-col">
                    <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-4 font-space">Engagement Spike</h3>
                    <p class="text-gray-400 text-sm flex-grow">Pertumbuhan riil. Bukan <em>fake followers</em>. Kami mengoptimasi konten agar masuk ke halaman <em>Explore</em> atau <em>FYP</em>, mendatangkan interaksi organik.</p>
                </div>
            </div>

            <!-- Bento Box 4: Insight Report (Besar) -->
            <div class="md:col-span-2 glow-card rounded-3xl p-8 relative overflow-hidden group">
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-[#9d00ff]/10 to-transparent"></div>
                <div class="relative z-10 flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-full md:w-1/2">
                        <h3 class="text-3xl font-black text-white mb-4 font-space">Comprehensive ROI Report</h3>
                        <p class="text-gray-400 mb-6">Di akhir periode, Anda akan menerima dokumen analitik yang jelas. Membedah apa yang berhasil, apa yang gagal, dan strategi pivot bulan berikutnya.</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-3 text-sm text-gray-300"><span class="text-[#9d00ff]">●</span> Metrik Reach & Impressions</li>
                            <li class="flex items-center gap-3 text-sm text-gray-300"><span class="text-[#9d00ff]">●</span> Analisis Konversi (Profile Visits, Link Clicks)</li>
                            <li class="flex items-center gap-3 text-sm text-gray-300"><span class="text-[#9d00ff]">●</span> Demografi Audiens</li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/2 bg-black/50 p-6 rounded-2xl border border-white/10">
                        <!-- Mockup Report Chart -->
                        <div class="flex items-end gap-3 h-32 w-full">
                            <div class="w-1/5 bg-white/10 rounded-t-sm h-[30%] hover:h-[40%] transition-all"></div>
                            <div class="w-1/5 bg-white/10 rounded-t-sm h-[45%] hover:h-[55%] transition-all"></div>
                            <div class="w-1/5 bg-white/10 rounded-t-sm h-[40%] hover:h-[50%] transition-all"></div>
                            <div class="w-1/5 bg-[#9d00ff]/60 rounded-t-sm h-[70%] hover:h-[80%] transition-all shadow-[0_0_15px_#9d00ff]"></div>
                            <div class="w-1/5 bg-[#f9005b] rounded-t-sm h-[95%] hover:h-[100%] transition-all shadow-[0_0_20px_#f9005b]"></div>
                        </div>
                        <div class="mt-4 text-center text-xs text-gray-500 font-mono border-t border-white/10 pt-2">Monthly Growth Trajectory</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 5. CALL TO ACTION -->
<section class="py-24 relative overflow-hidden bg-[#080815] z-20">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#9d00ff]/20 via-[#0a0a14] to-[#0a0a14]"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-8 font-space">
            Stop Being <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Invisible.</span>
        </h2>
        <p class="text-gray-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
            Kompetitor Anda sudah mencuri perhatian audiens Anda hari ini. Waktunya membalikkan keadaan. Konsultasikan status media sosial Anda sekarang secara gratis.
        </p>
        
        <a href="mailto:rizkialiakhbar@gmail.com" class="group relative inline-flex items-center justify-center bg-white text-black font-black text-xl px-10 py-5 overflow-hidden rounded-full transition-all hover:scale-105 shadow-[0_0_30px_rgba(255,255,255,0.2)]">
            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-[#f9005b] to-[#9d00ff] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span class="relative z-10 flex items-center gap-3 group-hover:text-white transition-colors">
                Audit Sosmed Kami Sekarang
                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </span>
        </a>
    </div>
</section>

<!-- LIGHTBOX MODAL DENGAN NAVIGATION -->
<div id="lightbox" class="fixed inset-0 z-[9995] bg-[#0a0a14]/95 backdrop-blur-2xl opacity-0 pointer-events-none transition-opacity duration-500 flex items-center justify-center">
    
    <!-- Tombol Close -->
    <button id="lightbox-close" class="absolute top-6 right-6 text-gray-400 hover:text-[#f9005b] transition-colors z-50 bg-black/50 border border-white/10 rounded-full p-2 hover:border-[#f9005b]">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

    <!-- Tombol Previous (Kiri) -->
    <button id="lightbox-prev" class="absolute left-4 md:left-10 text-gray-400 hover:text-[#9d00ff] transition-colors z-50 bg-black/50 border border-white/10 rounded-full p-3 hover:border-[#9d00ff] hover:-translate-x-1 transform">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>

    <!-- Tombol Next (Kanan) -->
    <button id="lightbox-next" class="absolute right-4 md:right-10 text-gray-400 hover:text-[#f9005b] transition-colors z-50 bg-black/50 border border-white/10 rounded-full p-3 hover:border-[#f9005b] hover:translate-x-1 transform">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>

    <!-- Kontainer Gambar Utama -->
    <div class="relative w-full h-full max-w-6xl max-h-[85vh] p-4 flex items-center justify-center">
        <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.8)] transition-all duration-300 transform scale-95 opacity-0" alt="Enlarged Visual">
    </div>
</div>

<!-- Load Three.js dari CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>

<!-- Script Three.js untuk Efek Network/Jaringan Data di Hero Section -->
<script>
    function initNetwork3D() {
        const container = document.getElementById('network-canvas');
        if (!container) return;

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 1, 1000);
        camera.position.z = 300;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        const particleCount = 150;
        const particles = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);
        const velocities = [];

        const colorPink = new THREE.Color('#f9005b');
        const colorPurple = new THREE.Color('#9d00ff');

        for (let i = 0; i < particleCount; i++) {
            positions[i * 3] = (Math.random() - 0.5) * 800;
            positions[i * 3 + 1] = (Math.random() - 0.5) * 800;
            positions[i * 3 + 2] = (Math.random() - 0.5) * 800;

            velocities.push({
                x: (Math.random() - 0.5) * 1.5,
                y: (Math.random() - 0.5) * 1.5,
                z: (Math.random() - 0.5) * 1.5
            });

            // Campur partikel warna pink dan ungu
            const mixedColor = Math.random() > 0.5 ? colorPink : colorPurple;
            colors[i * 3] = mixedColor.r;
            colors[i * 3 + 1] = mixedColor.g;
            colors[i * 3 + 2] = mixedColor.b;
        }

        particles.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        particles.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const pMaterial = new THREE.PointsMaterial({
            size: 4,
            vertexColors: true,
            blending: THREE.AdditiveBlending,
            transparent: true
        });

        const particleSystem = new THREE.Points(particles, pMaterial);
        scene.add(particleSystem);

        // Optimasi pembuatan koneksi garis 
        const lineMaterial = new THREE.LineBasicMaterial({
            color: 0x9d00ff,
            transparent: true,
            opacity: 0.15,
            blending: THREE.AdditiveBlending
        });

        const maxConnections = (particleCount * (particleCount - 1)) / 2;
        const linePositions = new Float32Array(maxConnections * 6);
        const lineGeometry = new THREE.BufferGeometry();
        lineGeometry.setAttribute('position', new THREE.BufferAttribute(linePositions, 3));
        
        const linesMesh = new THREE.LineSegments(lineGeometry, lineMaterial);
        scene.add(linesMesh);

        // Interaksi Mouse
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX - windowHalfX) * 0.15;
            mouseY = (e.clientY - windowHalfY) * 0.15;
        });

        function animate() {
            requestAnimationFrame(animate);

            // Gerakan halus kamera mengikuti mouse
            targetX = mouseX * 0.5;
            targetY = mouseY * 0.5;
            camera.position.x += (targetX - camera.position.x) * 0.05;
            camera.position.y += (-targetY - camera.position.y) * 0.05;
            camera.lookAt(scene.position);

            const posAttr = particleSystem.geometry.attributes.position.array;
            let vertexpos = 0;
            let numConnected = 0;

            for (let i = 0; i < particleCount; i++) {
                // Update pergerakan titik
                posAttr[i * 3] += velocities[i].x;
                posAttr[i * 3 + 1] += velocities[i].y;
                posAttr[i * 3 + 2] += velocities[i].z;

                // Batas pemantulan
                if (posAttr[i * 3] < -400 || posAttr[i * 3] > 400) velocities[i].x *= -1;
                if (posAttr[i * 3 + 1] < -400 || posAttr[i * 3 + 1] > 400) velocities[i].y *= -1;
                if (posAttr[i * 3 + 2] < -400 || posAttr[i * 3 + 2] > 400) velocities[i].z *= -1;

                // Cek jarak untuk menggambar garis
                for (let j = i + 1; j < particleCount; j++) {
                    const dx = posAttr[i * 3] - posAttr[j * 3];
                    const dy = posAttr[i * 3 + 1] - posAttr[j * 3 + 1];
                    const dz = posAttr[i * 3 + 2] - posAttr[j * 3 + 2];
                    const distSq = dx*dx + dy*dy + dz*dz;

                    // Garis akan terhubung jika jarak antar titik kurang dari 100
                    if (distSq < 10000) { 
                        linePositions[vertexpos++] = posAttr[i * 3];
                        linePositions[vertexpos++] = posAttr[i * 3 + 1];
                        linePositions[vertexpos++] = posAttr[i * 3 + 2];
                        linePositions[vertexpos++] = posAttr[j * 3];
                        linePositions[vertexpos++] = posAttr[j * 3 + 1];
                        linePositions[vertexpos++] = posAttr[j * 3 + 2];
                        numConnected++;
                    }
                }
            }

            linesMesh.geometry.setDrawRange(0, numConnected * 2);
            linesMesh.geometry.attributes.position.needsUpdate = true;
            particleSystem.geometry.attributes.position.needsUpdate = true;

            // Rotasi global
            particleSystem.rotation.y += 0.001;
            linesMesh.rotation.y += 0.001;

            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener('resize', () => {
            if (!container) return;
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        });
    }

    // Hanya inisiasi jika sudah selesai memuat dokumen
    document.addEventListener('DOMContentLoaded', initNetwork3D);
</script>

<!-- SCRIPT UNTUK LIGHTBOX GALLERY -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const closeBtn = document.getElementById('lightbox-close');
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        let currentIndex = 0;
        
        // Mengumpulkan semua URL gambar dari galeri
        const images = Array.from(galleryItems).map(item => item.querySelector('.gallery-img').src);

        // Fungsi Membuka Lightbox
        function openLightbox(index) {
            currentIndex = index;
            lightbox.classList.remove('opacity-0', 'pointer-events-none');
            lightbox.classList.add('opacity-100');
            document.body.style.overflow = 'hidden'; // Kunci scroll halaman belakang
            updateImage();
        }

        // Fungsi Menutup Lightbox
        function closeLightbox() {
            lightbox.classList.remove('opacity-100');
            lightbox.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = ''; // Buka kunci scroll
            lightboxImg.classList.add('scale-95', 'opacity-0');
            lightboxImg.classList.remove('scale-100', 'opacity-100');
        }

        // Fungsi Memperbarui Gambar yang Tampil dengan Efek Halus
        function updateImage() {
            // Efek memudar sesaat sebelum gambar berganti
            lightboxImg.classList.add('opacity-0', 'scale-95');
            lightboxImg.classList.remove('opacity-100', 'scale-100');
            
            setTimeout(() => {
                lightboxImg.src = images[currentIndex];
                lightboxImg.onload = () => {
                    lightboxImg.classList.remove('opacity-0', 'scale-95');
                    lightboxImg.classList.add('opacity-100', 'scale-100');
                };
            }, 200);
        }

        // Fungsi Next & Prev
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            updateImage();
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateImage();
        }

        // Event Listener untuk setiap gambar di halaman
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', () => openLightbox(index));
        });

        // Event Listener Tombol Navigasi
        closeBtn.addEventListener('click', closeLightbox);
        
        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah klik tembus ke background
            nextImage();
        });
        
        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            prevImage();
        });
        
        // Tutup lightbox jika area hitam (background) diklik
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox || e.target.closest('.flex.items-center.justify-center') === e.target) {
                closeLightbox();
            }
        });

        // Mendukung navigasi menggunakan Keyboard
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('opacity-100')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'ArrowLeft') prevImage();
            }
        });
    });
</script>

@endsection