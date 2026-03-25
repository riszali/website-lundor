@extends('layouts.main')

@section('title', 'Partner Portal - Lund\'or')

@section('content')
@php
/**
 * DEKLARASI TIPE DATA UNTUK VS CODE (INTELEPHENSE)
 * * @var \App\Models\User $authUser 
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $clientProjects
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $assetsForReview
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 */
@endphp
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<style>
    .font-space { font-family: 'Space Grotesk', sans-serif; }
    .glass-panel { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(249,0,91,0.5); border-radius: 10px; }
    .client-input { width: 100%; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1); color: white; font-size: 0.875rem; border-radius: 0.75rem; padding: 0.875rem 1rem; transition: all 0.3s; }
    .client-input:focus { outline: none; border-color: #f9005b; box-shadow: 0 0 15px rgba(249,0,91,0.2); }
    
    /* Layout Aplikasi Dashboard */
    .dashboard-layout { height: calc(100vh - 120px); min-height: 700px; }
    .tab-content { display: none; animation: fadeIn 0.4s ease-out forwards; }
    .tab-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Active Nav Item */
    .nav-item.active { background: rgba(249,0,91,0.15); border-left: 3px solid #f9005b; color: white; }
    .nav-item.active svg { color: #f9005b; }
</style>

<div class="fixed inset-0 z-0 bg-[#05050a] pointer-events-none">
    <div class="absolute top-1/4 right-0 w-[50rem] h-[50rem] bg-[#f9005b]/10 rounded-full blur-[150px]"></div>
</div>

<div class="relative z-10 pt-28 pb-8 px-4 lg:px-8 max-w-[120rem] mx-auto w-full">
    
    <!-- FLASH MESSAGES ALERT -->
    <div class="fixed top-24 right-8 z-[100] flex flex-col gap-2 pointer-events-none" id="alert-container">
        @if(session('success')) 
            <div class="p-4 rounded-xl border border-green-500/50 bg-green-500/20 backdrop-blur-md text-white font-mono text-sm flex items-center gap-3 shadow-2xl pointer-events-auto">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>{{ session('success') }}</span>
            </div> 
        @endif
        @if(session('error')) 
            <div class="p-4 rounded-xl border border-red-500/50 bg-red-500/20 backdrop-blur-md text-white font-mono text-sm flex items-center gap-3 shadow-2xl pointer-events-auto">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('error') }}</span>
            </div> 
        @endif
    </div>

    <!-- MAIN DASHBOARD APP CONTAINER -->
    <div class="dashboard-layout w-full bg-[#0a0a14]/80 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- SIDEBAR NAVIGATION -->
        <aside class="w-full md:w-64 bg-[#05050a] border-r border-white/10 flex flex-col shrink-0">
            <!-- User Profile Snippet -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-[#f9005b]/20 border border-[#f9005b]/50 flex items-center justify-center text-[#f9005b] font-bold text-lg shadow-[0_0_15px_rgba(249,0,91,0.3)]">
                        {{ substr($authUser->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <h2 class="text-white font-bold truncate text-sm">{{ $authUser->name }}</h2>
                        <p class="text-[10px] text-[#f9005b] font-mono uppercase tracking-widest truncate">Partner Entity</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-4 px-3 flex flex-col gap-1">
                <p class="px-4 text-[9px] font-mono text-gray-600 uppercase tracking-widest mb-2">Workspace</p>
                
                <button data-target="tab-overview" class="nav-item active w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Project Insight
                </button>
                
                <button data-target="tab-review" class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        Asset Review
                    </div>
                    @if(count($assetsForReview ?? []) > 0)
                        <span class="bg-[#f9005b] text-white text-[9px] font-bold px-2 py-0.5 rounded-full animate-pulse">{{ count($assetsForReview) }}</span>
                    @endif
                </button>
                
                <button data-target="tab-propose" class="nav-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                    Propose Project
                </button>

                <p class="px-4 text-[9px] font-mono text-gray-600 uppercase tracking-widest mt-6 mb-2">Network</p>
                
                <button data-target="tab-comms" class="nav-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    Agency Comms
                </button>
            </nav>

            <div class="p-6 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#f9005b] text-white hover:bg-pink-600 rounded-xl text-xs font-bold uppercase tracking-widest transition-all shadow-[0_0_15px_rgba(249,0,91,0.3)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Secure Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto custom-scrollbar bg-transparent relative">
            
            <!-- TAB 1: OVERVIEW -->
            <div id="tab-overview" class="tab-content active p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Project Insight</h2>
                <p class="text-gray-400 text-sm mb-10">Pantau status operasional dan progres dari inisiatif digital Anda.</p>

                <div class="space-y-6">
                    @forelse($clientProjects as $proj)
                        @php /** @var \App\Models\Project $proj */ @endphp
                        <div class="bg-black/50 border border-white/10 rounded-[2rem] p-8 relative overflow-hidden group">
                            <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-full blur-3xl group-hover:bg-[#f9005b]/10 transition-colors duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-end mb-4 relative z-10">
                                <div>
                                    <span class="text-[10px] font-mono text-[#f9005b] uppercase tracking-widest border border-[#f9005b]/30 bg-[#f9005b]/10 px-3 py-1 rounded-full">{{ $proj->category }}</span>
                                    <h4 class="text-2xl md:text-3xl font-bold text-white mt-4 font-space">{{ $proj->name }}</h4>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-500 text-[10px] font-mono uppercase mb-1 tracking-widest">Completion</p>
                                    <p class="text-white font-mono text-2xl md:text-3xl font-black">{{ $proj->progress }}%</p>
                                </div>
                            </div>
                            
                            <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden border border-white/10 mb-6 relative z-10">
                                <div class="h-full bg-gradient-to-r from-[#f9005b] to-[#ff0055] transition-all duration-1000 shadow-[0_0_15px_#f9005b]" style="width: {{ $proj->progress }}%;"></div>
                            </div>
                            
                            <p class="text-gray-400 text-sm font-light leading-relaxed max-w-3xl relative z-10 bg-white/5 p-4 rounded-xl border border-white/5">
                                {{ $proj->description }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-20 border border-dashed border-white/10 rounded-[2rem] opacity-50">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="text-white font-space text-lg font-bold mb-1">Tidak Ada Proyek Aktif</p>
                            <p class="text-gray-400 text-xs font-mono">Gunakan tab 'Propose Project' untuk memulai inisiatif baru.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 2: ASSET REVIEW -->
            <div id="tab-review" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Asset Review</h2>
                <p class="text-gray-400 text-sm mb-10">Tinjau hasil pekerjaan (*Deliverables*) yang telah melewati Quality Control Agensi.</p>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    @forelse($assetsForReview ?? [] as $asset)
                        @php /** @var \App\Models\Task $asset */ @endphp
                        <div class="bg-[#05050a] border border-[#f9005b]/30 rounded-[2rem] p-8 relative shadow-[0_10px_30px_rgba(249,0,91,0.05)]">
                            <h4 class="text-white text-xl font-bold font-space">{{ $asset->title }}</h4>
                            <p class="text-gray-400 text-xs mt-1">Project Link: <span class="text-white">{{ $asset->project->name ?? 'Unknown' }}</span></p>
                            
                            <div class="mt-8 flex flex-col gap-5">
                                <a href="#" class="flex items-center justify-center gap-2 w-full py-3 bg-white/5 border border-white/20 text-white rounded-xl text-xs font-bold hover:bg-white/10 hover:border-white/40 transition-all font-mono uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Preview Deliverable
                                </a>
                                
                                <form action="{{ route('client.asset.feedback', $asset->id) }}" method="POST" class="space-y-4 pt-5 border-t border-white/10">
                                    @csrf
                                    <p class="text-[10px] text-gray-500 font-mono uppercase tracking-widest mb-1">Provide Feedback</p>
                                    
                                    <div class="flex gap-4">
                                        <label class="flex-1 cursor-pointer">
                                            <input type="radio" name="feedback" value="approve" required class="hidden peer">
                                            <div class="text-center py-3 rounded-xl border border-white/10 text-gray-400 text-[10px] font-bold uppercase tracking-widest peer-checked:bg-green-600 peer-checked:text-white peer-checked:border-green-600 transition-all shadow-sm">Approve</div>
                                        </label>
                                        <label class="flex-1 cursor-pointer">
                                            <input type="radio" name="feedback" value="revision" class="hidden peer">
                                            <div class="text-center py-3 rounded-xl border border-white/10 text-gray-400 text-[10px] font-bold uppercase tracking-widest peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600 transition-all shadow-sm">Revision</div>
                                        </label>
                                    </div>
                                    
                                    <textarea name="notes" rows="2" class="client-input text-xs" placeholder="Tulis instruksi revisi spesifik jika ada..."></textarea>
                                    <button type="submit" class="w-full bg-[#f9005b] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-pink-600 transition-all shadow-[0_0_15px_rgba(249,0,91,0.3)]">Submit Decision</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="xl:col-span-2 text-center py-20 border border-dashed border-white/10 rounded-[2rem] opacity-30">
                            <p class="text-gray-400 font-mono text-sm uppercase tracking-widest">No Deliverables Awaiting Review</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 3: PROPOSE PROJECT -->
            <div id="tab-propose" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Propose Project</h2>
                <p class="text-gray-400 text-sm mb-10">Kirimkan proposal singkat (*brief*) untuk inisiatif digital Anda selanjutnya.</p>

                <div class="glass-panel p-8 md:p-10 rounded-[2rem] max-w-4xl border-white/10">
                    <form action="{{ route('client.project.request') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-2">Project Title</label>
                                <input type="text" name="title" required class="client-input" placeholder="e.g. Virtual Showroom 2026">
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-2">Required Expertise</label>
                                <select name="category" required class="client-input">
                                    <option value="" disabled selected>-- Select Discipline --</option>
                                    <option value="web-development">Web Development (Immersive)</option>
                                    <option value="animation">3D/2D Animation & Motion</option>
                                    <option value="uiux-design">UI/UX Design System</option>
                                    <option value="social-media">Digital Campaign / Social</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-2">Executive Summary / Brief</label>
                            <textarea name="description" rows="5" required class="client-input" placeholder="Jelaskan target, ekspektasi, dan timeline yang diinginkan..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-xl uppercase text-xs tracking-widest hover:bg-[#f9005b] hover:text-white transition-all shadow-[0_0_20px_rgba(255,255,255,0.1)]">Transmit Proposal</button>
                    </form>
                </div>
            </div>

            <!-- TAB 4: COMMS HUB -->
            <div id="tab-comms" class="tab-content h-full p-0 flex flex-col">
                <div class="flex-1 flex flex-col bg-transparent relative">
                    <!-- Chat Header -->
                    <div class="px-8 py-5 border-b border-white/10 bg-white/5 shrink-0 flex justify-between items-center backdrop-blur-md">
                        <div>
                            <p class="text-white text-base font-bold uppercase tracking-wide">Lund'or Agency HQ</p>
                            <span class="text-[10px] text-green-400 font-mono flex items-center gap-2 mt-1">
                                <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span> 
                                DEDICATED SUPPORT LINE
                            </span>
                        </div>
                        <div class="hidden md:block w-10 h-10 rounded-full border border-white/20 bg-white/10 flex items-center justify-center text-white font-bold">
                            HQ
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar flex flex-col bg-[#05050a]/50">
                        @forelse($messages as $msg)
                            @php /** @var \App\Models\Message $msg */ @endphp
                            <div class="{{ $msg->sender_id === $authUser->id ? 'self-end bg-[#f9005b] text-white shadow-[0_0_20px_rgba(249,0,91,0.2)]' : 'self-start bg-white/10 text-white border border-white/10' }} max-w-[85%] md:max-w-[70%] p-4 rounded-3xl {{ $msg->sender_id === $authUser->id ? 'rounded-tr-sm' : 'rounded-tl-sm' }}">
                                @if($msg->sender_id !== $authUser->id)
                                    <p class="text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Agency Support</p>
                                @endif
                                <p class="text-sm md:text-base leading-relaxed">{{ $msg->content }}</p>
                                <p class="text-[9px] opacity-60 mt-3 text-right font-mono">{{ $msg->created_at->format('H:i') }}</p>
                            </div>
                        @empty
                            <div class="flex-1 flex flex-col items-center justify-center opacity-20 text-center">
                                <svg class="w-12 h-12 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                <p class="text-[12px] font-mono uppercase tracking-[0.2em]">Connection Established</p>
                                <p class="text-[10px] text-gray-400 mt-2 font-mono">Tulis pesan Anda untuk menghubungi Project Manager kami.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Input Chat -->
                    <form action="{{ route('client.chat.send') }}" method="POST" class="p-6 bg-[#05050a] border-t border-white/10 flex gap-4 shrink-0">
                        @csrf
                        <input type="text" name="message" required placeholder="Transmit your message..." class="w-full bg-white/5 border border-white/20 text-white text-sm rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#f9005b] transition-colors">
                        <button type="submit" class="bg-[#f9005b] text-white px-8 py-3.5 rounded-xl hover:bg-pink-600 transition-all font-bold uppercase text-xs tracking-widest flex items-center gap-2 shadow-[0_0_20px_rgba(249,0,91,0.3)]">
                            Send
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- SCRIPT UNTUK TAB NAVIGATION SPA-LIKE -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.nav-item');
        const contents = document.querySelectorAll('.tab-content');
        const hash = window.location.hash;
        
        let activeTabId = localStorage.getItem('clientActiveTab') || 'tab-overview';
        if (hash === '#comms') activeTabId = 'tab-comms';

        function switchTab(targetId) {
            contents.forEach(c => c.classList.remove('active'));
            tabs.forEach(t => t.classList.remove('active'));

            const targetContent = document.getElementById(targetId);
            if(targetContent) targetContent.classList.add('active');

            const targetBtn = document.querySelector(`[data-target="${targetId}"]`);
            if(targetBtn) targetBtn.classList.add('active');

            localStorage.setItem('clientActiveTab', targetId);
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                const target = e.currentTarget.dataset.target;
                switchTab(target);
                if(target !== 'tab-comms') {
                    history.pushState("", document.title, window.location.pathname + window.location.search);
                }
            });
        });

        switchTab(activeTabId);

        // Hilangkan alert secara otomatis
        const alertContainer = document.getElementById('alert-container');
        if(alertContainer && alertContainer.children.length > 0) {
            setTimeout(() => {
                alertContainer.style.transition = 'opacity 0.5s ease';
                alertContainer.style.opacity = '0';
                setTimeout(() => alertContainer.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection