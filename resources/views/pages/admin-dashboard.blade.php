@extends('layouts.main')

@section('title', 'Admin Master Control - Lund\'or')

@section('content')
@php
/**
 * DEKLARASI TIPE DATA UNTUK VS CODE (INTELEPHENSE)
 * * @var \App\Models\User $authUser 
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectRequest[] $newRequests
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $editors
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $chatUsers
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $pendingAssets
 * @var \App\Models\User|null $activeChatUser
 */
@endphp
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<style>
    .font-space { font-family: 'Space Grotesk', sans-serif; }
    .glass-panel { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
    .admin-input { width: 100%; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1); color: white; font-size: 0.875rem; border-radius: 0.75rem; padding: 0.875rem 1rem; transition: all 0.3s; }
    .admin-input:focus { outline: none; border-color: #f9005b; box-shadow: 0 0 15px rgba(249,0,91,0.2); }
    
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
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60rem] h-[60rem] bg-[#f9005b]/5 rounded-full blur-[150px]"></div>
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
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#f9005b] to-[#9d00ff] flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($authUser->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <h2 class="text-white font-bold truncate text-sm">{{ $authUser->name }}</h2>
                        <p class="text-[10px] text-gray-500 font-mono uppercase tracking-widest truncate">Root Admin</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-4 px-3 flex flex-col gap-1">
                <p class="px-4 text-[9px] font-mono text-gray-600 uppercase tracking-widest mb-2">Workspace</p>
                
                <button data-target="tab-overview" class="nav-item active w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Overview
                </button>
                
                <button data-target="tab-requests" class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Project Requests
                    </div>
                    @if(count($newRequests) > 0)
                        <span class="bg-[#f9005b] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">{{ count($newRequests) }}</span>
                    @endif
                </button>
                
                <button data-target="tab-tasks" class="nav-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Task Dispatcher
                </button>
                
                <button data-target="tab-qc" class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        Quality Control
                    </div>
                    @if(count($pendingAssets ?? []) > 0)
                        <span class="bg-[#9d00ff] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">{{ count($pendingAssets) }}</span>
                    @endif
                </button>

                <p class="px-4 text-[9px] font-mono text-gray-600 uppercase tracking-widest mt-6 mb-2">Network</p>
                
                <button data-target="tab-comms" class="nav-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    Comms Hub
                </button>
                
                <button data-target="tab-system" class="nav-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    System & Data
                </button>
            </nav>

            <div class="p-6 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-xl text-xs font-bold uppercase tracking-widest transition-all border border-red-500/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto custom-scrollbar bg-transparent relative">
            
            <!-- TAB 1: OVERVIEW -->
            <div id="tab-overview" class="tab-content active p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Agency Overview</h2>
                <p class="text-gray-400 text-sm mb-10">Ringkasan status operasional jaringan proyek Anda.</p>

                <!-- Status Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                        <p class="text-gray-500 text-[10px] uppercase font-mono tracking-widest mb-1">Active Projects</p>
                        <p class="text-4xl font-black text-white">{{ count($projects) }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                        <p class="text-gray-500 text-[10px] uppercase font-mono tracking-widest mb-1">Pending Requests</p>
                        <p class="text-4xl font-black text-[#f9005b]">{{ count($newRequests) }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                        <p class="text-gray-500 text-[10px] uppercase font-mono tracking-widest mb-1">Awaiting QC</p>
                        <p class="text-4xl font-black text-[#9d00ff]">{{ count($pendingAssets ?? []) }}</p>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-white mb-6 font-space border-b border-white/10 pb-4">Ongoing Projects Progress</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($projects as $project)
                        <div class="bg-[#05050a] border border-white/5 rounded-2xl p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-white font-bold text-lg truncate">{{ $project->name }}</h4>
                                    <p class="text-gray-400 text-xs">Client: {{ $project->client->name }}</p>
                                </div>
                                <span class="px-2 py-1 bg-white/10 text-white text-[9px] uppercase font-mono rounded">{{ $project->category }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-mono text-gray-400 uppercase mb-2">
                                <span>Completion</span>
                                <span>{{ $project->progress }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-[#f9005b] to-[#9d00ff]" style="width: {{ $project->progress }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12 border border-dashed border-white/10 rounded-2xl opacity-50">
                            <p class="text-gray-400 text-sm font-mono">Belum ada proyek yang berjalan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 2: PROJECT REQUESTS -->
            <div id="tab-requests" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Project Proposals</h2>
                <p class="text-gray-400 text-sm mb-10">Tinjau dan setujui permintaan proyek baru dari Klien Partner Anda.</p>

                <div class="space-y-6">
                    @forelse($newRequests as $req)
                        <div class="bg-black/40 border border-white/10 rounded-2xl p-6 flex flex-col md:flex-row gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-white font-bold text-xl">{{ $req->title }}</h4>
                                    <span class="text-[#f9005b] text-[10px] font-mono border border-[#f9005b]/30 px-2 py-1 rounded uppercase">{{ $req->category }}</span>
                                </div>
                                <p class="text-gray-400 text-xs mb-4">Diajukan oleh: <span class="text-white font-bold">{{ $req->client->name }}</span> ({{ $req->created_at->diffForHumans() }})</p>
                                <div class="bg-white/5 p-4 rounded-xl">
                                    <p class="text-gray-300 text-sm italic font-light">"{{ $req->description }}"</p>
                                </div>
                            </div>
                            <div class="shrink-0 flex items-center justify-end border-t md:border-t-0 md:border-l border-white/10 pt-4 md:pt-0 md:pl-6">
                                <form action="{{ route('admin.request.approve', $req->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-3 bg-[#f9005b] text-white text-xs font-bold uppercase rounded-xl shadow-[0_0_15px_rgba(249,0,91,0.4)] hover:bg-pink-600 transition-all hover:scale-105">Approve & Start Project</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 border border-dashed border-white/10 rounded-3xl opacity-40">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-gray-300 font-mono text-sm uppercase tracking-widest">Inbox Empty</p>
                            <p class="text-gray-500 text-xs mt-2">Tidak ada proposal masuk saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 3: TASK DISPATCHER -->
            <div id="tab-tasks" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Task Dispatcher</h2>
                <p class="text-gray-400 text-sm mb-10">Pecah proyek menjadi tugas-tugas teknis dan distribusikan ke jaringan Editor/Artist.</p>

                <div class="glass-panel p-8 rounded-3xl mb-12 border-[#9d00ff]/30">
                    <form action="{{ route('admin.task.assign') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Target Project</label>
                                <select name="project_id" required class="admin-input">
                                    <option value="" disabled selected>-- Pilih Proyek Aktif --</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->id }}">{{ $proj->name }} (Client: {{ $proj->client->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Assign to Resource (Editor)</label>
                                <select name="editor_id" required class="admin-input">
                                    <option value="" disabled selected>-- Pilih Tim Editor/Artist --</option>
                                    @foreach($editors as $editor)
                                        <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Task Directive (Brief)</label>
                            <input type="text" name="title" required class="admin-input" placeholder="Contoh: Pembuatan Model 3D Karakter Utama & Rigging">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Priority Level</label>
                                <select name="priority" required class="admin-input">
                                    <option value="normal">Normal</option>
                                    <option value="high">High (Urgent)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Deadline</label>
                                <input type="date" name="due_date" required class="admin-input">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#9d00ff] text-white font-bold py-4 rounded-xl uppercase text-xs tracking-widest hover:bg-purple-600 transition-all shadow-[0_0_20px_rgba(157,0,255,0.3)]">Transmit Task</button>
                    </form>
                </div>
            </div>

            <!-- TAB 4: QUALITY CONTROL -->
            <div id="tab-qc" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Quality Control</h2>
                <p class="text-gray-400 text-sm mb-10">Review hasil pekerjaan dari Editor sebelum Anda meneruskannya ke Klien.</p>

                <div class="space-y-6">
                    @forelse($pendingAssets ?? [] as $asset)
                        <div class="bg-black/50 border border-white/10 rounded-2xl p-6 flex flex-col lg:flex-row gap-6 items-center">
                            <div class="flex-1 w-full">
                                <span class="text-[9px] font-mono text-gray-500 uppercase bg-white/10 px-2 py-1 rounded mb-2 inline-block">Project: {{ $asset->project->name ?? 'Unknown' }}</span>
                                <h4 class="text-white font-bold text-xl">{{ $asset->title }}</h4>
                                <p class="text-gray-400 text-xs mt-2 flex items-center gap-2">
                                    Dikerjakan oleh: <span class="text-white bg-white/10 px-2 py-0.5 rounded">{{ $asset->editor->name }}</span>
                                </p>
                            </div>
                            
                            <div class="w-full lg:w-auto shrink-0 flex items-center gap-4 border-t lg:border-t-0 border-white/10 pt-4 lg:pt-0">
                                <a href="#" class="px-4 py-2 border border-[#9d00ff] text-[#9d00ff] text-xs font-bold uppercase rounded-lg hover:bg-[#9d00ff] hover:text-white transition-all text-center flex-1 lg:flex-none">Download File</a>
                                
                                <form action="{{ route('admin.asset.review', $asset->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <button type="submit" name="action" value="approve" class="px-4 py-2 bg-green-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-green-500 transition-all">Approve & Pass</button>
                                    <button type="submit" name="action" value="reject" class="px-4 py-2 bg-red-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-red-500 transition-all">Reject (Revisi)</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 border border-dashed border-white/10 rounded-3xl opacity-40">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-gray-300 font-mono text-sm uppercase tracking-widest">Queue Clear</p>
                            <p class="text-gray-500 text-xs mt-2">Tidak ada aset dari Editor yang menunggu review saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 5: SYSTEM & DATA (USER & BLOG) -->
            <div id="tab-system" class="tab-content p-8 md:p-12">
                <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">System Management</h2>
                <p class="text-gray-400 text-sm mb-10">Registrasi node akun baru dan pengelolaan konten website publik.</p>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-10">
                    
                    <!-- Register User -->
                    <div class="glass-panel p-8 rounded-3xl border-white/10">
                        <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-widest border-b border-white/10 pb-4">Register New Account</h3>
                        <form action="{{ route('admin.user.create') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Role/Peran</label>
                                <select name="role" required class="admin-input">
                                    <option value="client">Client Partner</option>
                                    <option value="artist">Creative Editor</option>
                                    <option value="admin">System Admin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Nama Entitas / Perusahaan</label>
                                <input type="text" name="name" required class="admin-input">
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Email Akses</label>
                                <input type="email" name="email" required class="admin-input">
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Password</label>
                                <input type="password" name="password" required class="admin-input">
                            </div>
                            <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl uppercase text-xs tracking-widest hover:bg-gray-300">Create Access</button>
                        </form>
                    </div>

                    <!-- Blog Publish -->
                    <div class="glass-panel p-8 rounded-3xl border-[#f9005b]/20">
                        <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-widest border-b border-white/10 pb-4">Publish Agency Insight (Blog)</h3>
                        <form action="{{ route('admin.blog.create') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Judul Artikel</label>
                                <input type="text" name="title" required class="admin-input">
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Cover Image (Thumbnail)</label>
                                <input type="file" name="image" class="admin-input p-2 text-xs text-gray-400 bg-black/40">
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-gray-400 uppercase mb-2">Isi Konten</label>
                                <textarea name="content" rows="6" required class="admin-input"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#f9005b] text-white font-bold py-3.5 rounded-xl uppercase text-xs tracking-widest hover:bg-pink-600 shadow-[0_0_15px_rgba(249,0,91,0.3)]">Publish Content</button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- TAB 6: COMMS HUB -->
            <div id="tab-comms" class="tab-content h-full p-0 flex flex-col md:flex-row">
                
                <!-- Contact Sidebar Internal -->
                <div class="w-full md:w-1/3 lg:w-1/4 border-b md:border-b-0 md:border-r border-white/10 bg-black/30 overflow-y-auto custom-scrollbar">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-lg font-bold text-white font-space tracking-tight">Comms Hub</h3>
                        <p class="text-gray-500 text-[10px] uppercase font-mono tracking-widest mt-1">Select Network</p>
                    </div>
                    <div class="p-3 space-y-2">
                        @foreach($chatUsers as $cu)
                            <!-- Ketika kontak diklik, url berubah & JS akan mempertahankan tab COMMS -->
                            <a href="?chat_with={{ $cu->id }}#comms" class="block p-4 rounded-2xl transition-all {{ request('chat_with') == $cu->id ? 'bg-[#f9005b]/10 border border-[#f9005b]/30 shadow-inner' : 'hover:bg-white/5 border border-transparent' }}">
                                <div class="flex justify-between items-center">
                                    <p class="text-white text-sm font-bold truncate">{{ $cu->name }}</p>
                                    <span class="w-2 h-2 rounded-full {{ $cu->role == 'client' ? 'bg-[#f9005b]' : 'bg-[#9d00ff]' }}"></span>
                                </div>
                                <p class="text-[10px] font-mono uppercase {{ $cu->role == 'client' ? 'text-[#f9005b]' : 'text-[#9d00ff]' }} mt-1">{{ $cu->role }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-1 flex flex-col bg-transparent relative">
                    @if(request('chat_with'))
                        @if($activeChatUser)
                            <div class="px-8 py-5 border-b border-white/10 bg-white/5 shrink-0 flex justify-between items-center backdrop-blur-md">
                                <div>
                                    <p class="text-white text-base font-bold uppercase tracking-wide">{{ $activeChatUser->name }}</p>
                                    <span class="text-[10px] text-green-400 font-mono flex items-center gap-2 mt-1">
                                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span> 
                                        SECURE LINE CONNECTED
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar flex flex-col bg-black/10">
                            @forelse($messages as $msg)
                                <div class="{{ $msg->sender_id === $authUser->id ? 'self-end bg-white text-black' : 'self-start bg-[#0a0a14] border border-white/10 text-white' }} max-w-[85%] md:max-w-[70%] p-4 rounded-3xl {{ $msg->sender_id === $authUser->id ? 'rounded-tr-sm shadow-xl' : 'rounded-tl-sm shadow-lg' }}">
                                    @if($msg->sender_id !== $authUser->id)
                                        <p class="text-[10px] font-black text-gray-500 uppercase mb-2 tracking-widest">{{ $msg->sender->name }}</p>
                                    @endif
                                    <p class="text-sm md:text-base leading-relaxed">{{ $msg->content }}</p>
                                    <p class="text-[9px] opacity-40 mt-3 text-right font-mono">{{ $msg->created_at->format('H:i') }}</p>
                                </div>
                            @empty
                                <div class="flex-1 flex flex-col items-center justify-center opacity-20">
                                    <svg class="w-12 h-12 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <p class="text-[12px] font-mono uppercase tracking-[0.2em]">No Messages Yet</p>
                                </div>
                            @endforelse
                        </div>

                        <form action="{{ route('admin.chat.send') }}" method="POST" class="p-6 bg-[#05050a] border-t border-white/10 flex gap-4 shrink-0">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ request('chat_with') }}">
                            <input type="text" name="message" required placeholder="Type your directive here..." class="w-full bg-white/5 border border-white/20 text-white text-sm rounded-xl px-5 py-3.5 focus:outline-none focus:border-white focus:bg-white/10 transition-all">
                            <button type="submit" class="bg-white text-black px-8 py-3.5 rounded-xl hover:bg-gray-200 transition-all font-bold uppercase text-xs tracking-widest flex items-center gap-2 shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                                Send
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </form>
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-8 opacity-20">
                            <svg class="w-20 h-20 text-white mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="text-sm font-mono uppercase tracking-widest">Select a contact from the network<br>to start secure transmission.</p>
                        </div>
                    @endif
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
        
        // 1. Cek parameter URL atau Hash untuk mempertahankan tab setelah reload
        const urlParams = new URLSearchParams(window.location.search);
        const hash = window.location.hash;
        
        let activeTabId = localStorage.getItem('adminActiveTab') || 'tab-overview';
        
        // Jika ada query chat_with atau hash #comms, paksa buka tab Comms
        if (urlParams.has('chat_with') || hash === '#comms') {
            activeTabId = 'tab-comms';
        }

        // 2. Fungsi Switch Tab
        function switchTab(targetId) {
            // Sembunyikan semua konten
            contents.forEach(c => c.classList.remove('active'));
            // Reset style semua tombol
            tabs.forEach(t => {
                t.classList.remove('active');
            });

            // Aktifkan konten terpilih
            const targetContent = document.getElementById(targetId);
            if(targetContent) targetContent.classList.add('active');

            // Aktifkan tombol terpilih
            const targetBtn = document.querySelector(`[data-target="${targetId}"]`);
            if(targetBtn) targetBtn.classList.add('active');

            // Simpan state
            localStorage.setItem('adminActiveTab', targetId);
        }

        // 3. Pasang Event Listener ke tombol
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                const target = e.currentTarget.dataset.target;
                switchTab(target);
                
                // Hilangkan hash #comms dari URL jika pindah tab agar bersih
                if(target !== 'tab-comms') {
                    history.pushState("", document.title, window.location.pathname + window.location.search);
                }
            });
        });

        // 4. Jalankan saat awal render
        switchTab(activeTabId);

        // 5. Hilangkan alert secara otomatis setelah 5 detik
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