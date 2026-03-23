@extends('layouts.main')

@section('title', 'Contact Us - Lund\'or Imagine Digital')

@section('content')
<!-- Memuat font khusus -->
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

<style>
    /* Efek tombol gradasi khusus untuk form */
    .btn-gradient-submit {
        background: linear-gradient(#0a0a14, #0a0a14) padding-box,
                    linear-gradient(45deg, #f9005b, #9d00ff) border-box;
        border: 2px solid transparent;
        transition: all 0.4s ease;
    }
    .btn-gradient-submit:hover {
        background: linear-gradient(45deg, #f9005b, #9d00ff) padding-box,
                    linear-gradient(45deg, #f9005b, #9d00ff) border-box;
        box-shadow: 0 0 30px rgba(249,0,91,0.5);
        transform: translateY(-2px);
    }
    
    /* Input field styling */
    .glass-input {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        transition: all 0.3s ease;
    }
    .glass-input:focus {
        outline: none;
        border-color: #f9005b;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 15px rgba(249,0,91,0.2);
    }
</style>

<section class="pt-32 pb-20 md:pt-40 md:pb-32 min-h-screen bg-[#05050a] relative overflow-hidden flex items-center z-30">
    <!-- Dekorasi Background (Glowing Orbs) -->
    <div class="absolute top-20 left-[5%] w-[30rem] h-[30rem] bg-[#f9005b]/10 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>
    <div class="absolute bottom-10 right-[5%] w-[30rem] h-[30rem] bg-[#9d00ff]/10 rounded-full blur-[120px] pointer-events-none z-0 transform-gpu"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10 w-full">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Kolom Kiri: Teks & Info Kontak -->
            <div class="flex flex-col justify-center">
                <p class="text-[#f9005b] font-mono text-sm tracking-widest uppercase mb-4 animate-pulse">/// INITIATE CONNECTION ///</p>
                <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6 leading-none" style="font-family: 'Impact', sans-serif;">
                    Let's Build <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9005b] to-[#9d00ff]">Something</span><br>
                    Crazy.
                </h1>
                <p class="text-gray-400 text-lg md:text-xl font-sans mb-10 max-w-md leading-relaxed">
                    Punya ide liar yang menolak batasan konvensional? Kami siap mendengarkan. Hubungi kami dan mari racik kekacauan digital yang memukau.
                </p>

                <div class="space-y-8">
                    <!-- Email -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-all duration-300 shadow-lg shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Electronic Mail</p>
                            <a href="mailto:hello@lundor.id" class="text-white font-bold text-lg hover:text-[#f9005b] transition-colors">hello@lundor.id</a>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white group-hover:bg-[#9d00ff] group-hover:border-[#9d00ff] transition-all duration-300 shadow-lg shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Headquarters</p>
                            <p class="text-white font-bold text-lg">Jakarta Selatan,<br>DKI Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form -->
            <div class="relative">
                <!-- Decorative Frame -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#f9005b]/20 to-[#9d00ff]/20 rounded-[2rem] transform rotate-3 scale-105 blur-sm opacity-50 z-0"></div>
                
                <div class="bg-[#0a0a14]/90 backdrop-blur-xl border border-white/10 p-8 md:p-12 rounded-[2rem] relative z-10 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <h3 class="text-2xl font-bold text-white mb-8 font-sans">Kirimkan Pesan Anda</h3>
                    
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="name" class="text-xs font-mono text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="glass-input w-full px-4 py-3.5 rounded-xl text-sm" placeholder="John Doe" required>
                            </div>
                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="text-xs font-mono text-gray-400 uppercase tracking-widest">Email</label>
                                <input type="email" id="email" name="email" class="glass-input w-full px-4 py-3.5 rounded-xl text-sm" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="space-y-2">
                            <label for="subject" class="text-xs font-mono text-gray-400 uppercase tracking-widest">Subjek / Topik</label>
                            <select id="subject" name="subject" class="glass-input w-full px-4 py-3.5 rounded-xl text-sm appearance-none">
                                <option value="" class="bg-[#0a0a14]">Pilih Topik Diskusi...</option>
                                <option value="web" class="bg-[#0a0a14]">Web Development / 3D WebGL</option>
                                <option value="uiux" class="bg-[#0a0a14]">UI/UX Design</option>
                                <option value="sosmed" class="bg-[#0a0a14]">Social Media Management</option>
                                <option value="other" class="bg-[#0a0a14]">Kolaborasi Lainnya</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="space-y-2">
                            <label for="message" class="text-xs font-mono text-gray-400 uppercase tracking-widest">Pesan</label>
                            <textarea id="message" name="message" rows="4" class="glass-input w-full px-4 py-3.5 rounded-xl text-sm resize-none" placeholder="Ceritakan ide brilian Anda di sini..." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-gradient-submit w-full py-4 rounded-xl text-white font-bold uppercase tracking-widest flex items-center justify-center gap-3">
                            <span>Kirim Pesan</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection