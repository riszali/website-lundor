@extends('layouts.main')

@section('title', 'System Login - Lund\'or Imagine Digital')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">

<style>
    .font-space { font-family: 'Space Grotesk', sans-serif; }
    
    .noise-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
    }

    .role-card {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        cursor: pointer;
    }
    .role-card:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateY(-5px);
    }
    .role-card.active-role {
        border-color: var(--role-color);
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 10px 40px var(--role-shadow);
    }

    /* Form transition */
    #auth-container {
        display: flex;
        width: 200%;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .auth-step {
        width: 50%;
        flex-shrink: 0;
    }
    
    .input-cyber {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }
    .input-cyber:focus {
        outline: none;
        border-color: var(--role-color);
        box-shadow: 0 0 15px var(--role-shadow);
        background: rgba(0, 0, 0, 0.6);
    }
</style>

<div class="noise-bg"></div>

<!-- Background Elements -->
<div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
    <div id="glow-orb" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] rounded-full blur-[150px] opacity-20 transition-colors duration-700 bg-white"></div>
</div>

<section class="relative z-10 w-full min-h-screen flex items-center justify-center bg-[#05050a]/80 pt-20 px-4">
    <div class="w-full max-w-4xl mx-auto overflow-hidden">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="mb-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-white animate-pulse" id="status-dot"></span>
                <span class="text-[10px] font-mono text-gray-300 tracking-[0.2em] uppercase" id="status-text">SYSTEM SECURED // AWAITING ID</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-white font-space uppercase tracking-tighter">
                Access <span id="title-accent" class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-white transition-all duration-500">Portal</span>
            </h1>
        </div>

        <!-- Slider Container -->
        <div class="overflow-hidden relative w-full">
            <div id="auth-container" class="transform translate-x-0">
                
                <!-- STEP 1: PILIH ROLE -->
                <div class="auth-step px-2">
                    <p class="text-center text-gray-400 font-mono text-xs uppercase tracking-widest mb-8">Select Your Authorization Level</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                        
                        <!-- Role: Admin -->
                        <div class="role-card rounded-2xl p-6 text-center group" onclick="selectRole('admin', '#ffffff', 'rgba(255,255,255,0.2)', 'Lund\'or Administrator')" style="--role-color: #ffffff; --role-shadow: rgba(255,255,255,0.2);">
                            <div class="w-16 h-16 mx-auto rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-4 group-hover:border-white group-hover:bg-white/10 transition-colors">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white font-space tracking-widest uppercase">Admin</h3>
                            <p class="text-[10px] text-gray-500 font-mono mt-2 uppercase tracking-widest">Master Control</p>
                        </div>

                        <!-- Role: Client -->
                        <div class="role-card rounded-2xl p-6 text-center group" onclick="selectRole('client', '#f9005b', 'rgba(249,0,91,0.2)', 'Client Partner')" style="--role-color: #f9005b; --role-shadow: rgba(249,0,91,0.2);">
                            <div class="w-16 h-16 mx-auto rounded-full bg-[#f9005b]/5 border border-[#f9005b]/20 flex items-center justify-center mb-4 group-hover:border-[#f9005b] group-hover:bg-[#f9005b]/20 transition-colors">
                                <svg class="w-7 h-7 text-[#f9005b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white font-space tracking-widest uppercase">Client</h3>
                            <p class="text-[10px] text-gray-500 font-mono mt-2 uppercase tracking-widest">Project Dashboard</p>
                        </div>

                        <!-- Role: Artist / Editor -->
                        <div class="role-card rounded-2xl p-6 text-center group" onclick="selectRole('artist', '#9d00ff', 'rgba(157,0,255,0.2)', 'Creative Artist')" style="--role-color: #9d00ff; --role-shadow: rgba(157,0,255,0.2);">
                            <div class="w-16 h-16 mx-auto rounded-full bg-[#9d00ff]/5 border border-[#9d00ff]/20 flex items-center justify-center mb-4 group-hover:border-[#9d00ff] group-hover:bg-[#9d00ff]/20 transition-colors">
                                <svg class="w-7 h-7 text-[#9d00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white font-space tracking-widest uppercase">Editor</h3>
                            <p class="text-[10px] text-gray-500 font-mono mt-2 uppercase tracking-widest">Asset Pipeline</p>
                        </div>

                    </div>
                </div>

                <!-- STEP 2: FORM LOGIN -->
                <div class="auth-step px-2 flex justify-center">
                    <div class="w-full max-w-md bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2rem] p-8 md:p-10 relative overflow-hidden">
                        
                        <!-- Back Button -->
                        <button onclick="goBack()" class="absolute top-6 left-6 text-gray-400 hover:text-white flex items-center gap-2 text-xs font-mono tracking-widest uppercase transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back
                        </button>

                        <div class="mt-8 mb-8 text-center">
                            <h2 id="form-role-title" class="text-2xl font-black text-white font-space uppercase tracking-tighter">Login</h2>
                            <p class="text-xs font-mono text-gray-500 mt-2 tracking-widest uppercase">Enter your credentials</p>
                        </div>

                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <input type="hidden" name="role" id="role-input" value="">
                            
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                                <input type="email" name="email" required class="input-cyber w-full px-5 py-3 rounded-xl text-sm" placeholder="ID@lundor.com">
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-[10px] font-mono text-gray-400 uppercase tracking-widest">Password</label>
                                    <a href="#" class="text-[10px] font-mono text-gray-500 hover:text-white transition-colors">Forgot?</a>
                                </div>
                                <input type="password" name="password" required class="input-cyber w-full px-5 py-3 rounded-xl text-sm" placeholder="••••••••">
                            </div>

                            <button type="submit" id="submit-btn" class="w-full mt-6 bg-white text-black font-bold uppercase tracking-widest text-xs py-4 rounded-xl hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                                Initialize Access
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</section>

<script>
    const container = document.getElementById('auth-container');
    const glowOrb = document.getElementById('glow-orb');
    const titleAccent = document.getElementById('title-accent');
    const roleInput = document.getElementById('role-input');
    const formTitle = document.getElementById('form-role-title');
    const submitBtn = document.getElementById('submit-btn');
    const statusDot = document.getElementById('status-dot');
    const statusText = document.getElementById('status-text');

    function selectRole(role, hexColor, shadowColor, roleName) {
        // Update Form Data
        roleInput.value = role;
        formTitle.innerText = roleName;
        
        // Animasi CSS Variables
        document.documentElement.style.setProperty('--role-color', hexColor);
        document.documentElement.style.setProperty('--role-shadow', shadowColor);
        
        // Update Warna Tema
        glowOrb.style.backgroundColor = hexColor;
        titleAccent.style.backgroundImage = `linear-gradient(to right, ${hexColor}, #ffffff)`;
        submitBtn.style.backgroundColor = hexColor;
        submitBtn.style.color = role === 'admin' ? '#000' : '#fff';
        submitBtn.style.boxShadow = `0 0 20px ${shadowColor}`;
        
        statusDot.style.backgroundColor = hexColor;
        statusText.innerText = `AUTHENTICATING // ${role.toUpperCase()}`;
        statusText.style.color = hexColor;

        // Slide ke Form
        container.style.transform = 'translateX(-50%)';
    }

    function goBack() {
        // Reset ke pemilihan role
        container.style.transform = 'translateX(0)';
        glowOrb.style.backgroundColor = '#ffffff';
        titleAccent.style.backgroundImage = 'linear-gradient(to right, #9ca3af, #ffffff)';
        statusDot.style.backgroundColor = '#ffffff';
        statusText.innerText = 'SYSTEM SECURED // AWAITING ID';
        statusText.style.color = '#d1d5db';
        
        // Kosongkan input
        document.querySelectorAll('input[type="email"], input[type="password"]').forEach(input => input.value = '');
    }
</script>
@endsection