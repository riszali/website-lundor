@extends('layouts.main')

@section('title', 'Artist Pipeline - Lund\'or')

@section('content')
@php
/**
 * DEKLARASI TIPE DATA UNTUK VS CODE (INTELEPHENSE)
 * * @var \App\Models\User $authUser 
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 */

// Mengekstrak data proyek unik dari daftar tugas (Task) yang di-assign ke Editor ini
$editorProjects = collect($tasks)->pluck('project')->unique('id')->filter();
$activeTasks = collect($tasks)->where('status', 'in_progress')->count();
@endphp
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700;900&display=swap" rel="stylesheet">
<style>
    .font-space { font-family: 'Space Grotesk', sans-serif; }
    .glass-panel { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(157,0,255,0.5); border-radius: 10px; }
    
    /* Layout Aplikasi Dashboard */
    .dashboard-layout { height: calc(100vh - 120px); min-height: 700px; }
    .tab-content { display: none; animation: fadeIn 0.4s ease-out forwards; }
    .tab-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Active Nav Item */
    .nav-item.active { background: rgba(157,0,255,0.15); border-left: 3px solid #9d00ff; color: white; }
    .nav-item.active svg { color: #9d00ff; }

    /* Task Cards Customization */
    .task-card { background: rgba(0,0,0,0.6); border: 1px solid rgba(157, 0, 255, 0.1); border-left: 5px solid #9d00ff; transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1); }
    .task-card:hover { border-left-width: 10px; background: rgba(10,10,20,0.8); }
    .task-card.priority-high { border-left-color: #f9005b; }
    .status-pill { font-size: 9px; font-weight: 900; padding: 0.35rem 0.75rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.1em; }
    .status-pending { background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.1); }
    .status-progress { background: rgba(157,0,255,0.15); color: #9d00ff; border: 1px solid rgba(157,0,255,0.3); }
    .status-done { background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }
</style>

<div class="fixed inset-0 z-0 bg-[#05050a] pointer-events-none">
    <div class="absolute bottom-0 left-0 w-[50rem] h-[50rem] bg-[#9d00ff]/10 rounded-full blur-[150px]"></div>
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
                    <div class="w-10 h-10 rounded-full bg-[#9d00ff]/20 border border-[#9d00ff]/50 flex items-center justify-center text-[#9d00ff] font-bold text-lg shadow-[0_0_15px_rgba(157,0,255,0.3)]">
                        {{ substr($authUser->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <h2 class="text-white font-bold truncate text-sm">{{ $authUser->name }}</h2>
                        <p class="text-[10px] text-[#9d00ff] font-mono uppercase tracking-widest truncate">Creative Node</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-4 px-3 flex flex-col gap-1">
                <p class="px-4 text-[9px] font-mono text-gray-600 uppercase tracking-widest mb-2">Workspace</p>
                
                <button data-target="tab-projects" class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Project Insight
                    </div>
                    @if(count($editorProjects) > 0)
                        <span class="bg-white/10 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">{{ count($editorProjects) }}</span>
                    @endif
                </button>

                <button data-target="tab-tasks" class="nav-item active w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all text-left font-space text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Task Board
                    </div>
                    @if($activeTasks > 0)
                        <span class="bg-[#9d00ff] text-white text-[9px] font-bold px-2 py-0.5 rounded-full animate-pulse">{{ $activeTasks }}</span>
                    @endif
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
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#9d00ff]/20 text-[#9d00ff] border border-[#9d00ff]/50 hover:bg-[#9d00ff] hover:text-white rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Disconnect
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto custom-scrollbar bg-transparent relative">
            
            <!-- TAB 1: PROJECT INSIGHT (NEW) -->
            <div id="tab-projects" class="tab-content p-8 md:p-12">
                <div class="flex justify-between items-end border-b border-white/10 pb-6 mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Project Insight</h2>
                        <p class="text-gray-400 text-sm">Pantau progres keseluruhan dari proyek-proyek yang melibatkan Anda.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse($editorProjects as $proj)
                        @php /** @var \App\Models\Project $proj */ @endphp
                        <div class="bg-black/50 border border-[#9d00ff]/20 rounded-[2rem] p-8 relative overflow-hidden group">
                            <div class="absolute right-0 top-0 w-32 h-32 bg-[#9d00ff]/5 rounded-full blur-3xl group-hover:bg-[#9d00ff]/15 transition-colors duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-end mb-4 relative z-10">
                                <div>
                                    <span class="text-[10px] font-mono text-[#9d00ff] uppercase tracking-widest border border-[#9d00ff]/30 bg-[#9d00ff]/10 px-3 py-1 rounded-full">{{ $proj->category }}</span>
                                    <h4 class="text-2xl md:text-3xl font-bold text-white mt-4 font-space">{{ $proj->name }}</h4>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-500 text-[10px] font-mono uppercase mb-1 tracking-widest">Project Completion</p>
                                    <p class="text-white font-mono text-2xl md:text-3xl font-black">{{ $proj->progress }}%</p>
                                </div>
                            </div>
                            
                            <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden border border-white/10 mb-6 relative z-10">
                                <div class="h-full bg-gradient-to-r from-[#9d00ff] via-[#c653ff] to-[#f9005b] transition-all duration-1000 shadow-[0_0_15px_#9d00ff]" style="width: {{ $proj->progress }}%;"></div>
                            </div>
                            
                            <div class="relative z-10 bg-white/5 p-4 rounded-xl border border-white/5 flex items-start gap-4">
                                <div class="p-2 bg-[#9d00ff]/20 rounded-lg shrink-0 text-[#9d00ff]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-gray-400 text-xs font-light leading-relaxed">
                                    Progres proyek di atas akan otomatis bertambah saat Anda merubah status Tugas Anda menjadi <span class="text-white font-bold">Completed</span> dan melakukan *Push Deliverable* ke tim QC Admin.
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 border border-dashed border-white/10 rounded-[2rem] opacity-50">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="text-white font-space text-lg font-bold mb-1">Belum Terhubung ke Proyek</p>
                            <p class="text-gray-400 text-xs font-mono">Anda akan melihat status proyek setelah Admin memberikan tugas teknis.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 2: TASK BOARD -->
            <div id="tab-tasks" class="tab-content active p-8 md:p-12">
                <div class="flex justify-between items-end border-b border-white/10 pb-6 mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-white font-space tracking-tight mb-2">Creative Pipeline</h2>
                        <p class="text-gray-400 text-sm">Daftar direktif pekerjaan teknis yang di-assign ke Node Anda.</p>
                    </div>
                    <span class="hidden md:inline-block px-3 py-1 bg-white/5 border border-white/10 rounded text-[10px] font-mono text-gray-500 uppercase tracking-widest">{{ count($tasks) }} Tasks Total</span>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    @forelse($tasks as $task)
                        @php /** @var \App\Models\Task $task */ @endphp
                        <div class="task-card p-8 rounded-3xl relative flex flex-col justify-between h-full {{ $task->priority === 'high' ? 'priority-high' : '' }}">
                            
                            <!-- Header Info -->
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="status-pill status-{{ $task->status == 'in_progress' ? 'progress' : ($task->status == 'completed' ? 'done' : 'pending') }}">
                                        {{ str_replace('_', ' ', $task->status) }}
                                    </span>
                                    @if($task->priority === 'high')
                                        <span class="status-pill bg-[#f9005b]/20 text-[#f9005b] border border-[#f9005b]/30">URGENT_LEVEL_A</span>
                                    @endif
                                </div>
                                <h4 class="text-white font-bold text-2xl font-space tracking-tight leading-snug mb-3">{{ $task->title }}</h4>
                                
                                <!-- Context: Project Progress di dalam Task -->
                                <div class="bg-[#05050a] rounded-xl p-4 border border-white/5 shadow-inner mt-4 mb-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-[9px] text-gray-500 font-mono uppercase tracking-widest flex items-center gap-2">
                                            <svg class="w-3 h-3 text-[#9d00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                            Proj: {{ $task->project->name ?? 'Unknown' }}
                                        </span>
                                        <span class="text-white font-mono text-xs font-bold">{{ $task->project->progress ?? 0 }}%</span>
                                    </div>
                                    <div class="w-full h-1 bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-[#9d00ff] to-[#f9005b]" style="width: {{ $task->project->progress ?? 0 }}%;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Due Date & Actions -->
                            <div class="mt-6 pt-6 border-t border-white/5">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <p class="text-gray-600 text-[9px] font-mono uppercase tracking-widest mb-1">Deadline Sequence</p>
                                        <p class="text-white font-mono text-lg font-bold">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                                    </div>
                                    
                                    @if($task->status !== 'completed')
                                        <form action="{{ route('editor.task.update', $task->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            @if($task->status === 'pending')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="submit" class="px-6 py-3 bg-[#9d00ff] text-white text-[10px] font-bold uppercase tracking-widest rounded-xl shadow-[0_0_15px_rgba(157,0,255,0.3)] hover:scale-105 transition-all">Start Operation</button>
                                            @elseif($task->status === 'in_progress')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="px-6 py-3 bg-green-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl shadow-[0_0_15px_rgba(34,197,94,0.3)] hover:scale-105 transition-all">Mark as Complete</button>
                                            @endif
                                        </form>
                                    @else
                                        <div class="flex items-center gap-2 text-green-500 font-mono text-[10px] uppercase font-bold bg-green-500/10 px-4 py-2 rounded-xl border border-green-500/30">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            Finalized
                                        </div>
                                    @endif
                                </div>

                                <!-- DYNAMIC UPLOAD PANEL -->
                                @if($task->status === 'in_progress')
                                    <div class="bg-[#05050a] border border-dashed border-[#9d00ff]/30 p-5 rounded-2xl relative overflow-hidden group/upload mt-2">
                                        <h5 class="text-[#9d00ff] text-[10px] font-bold uppercase mb-3 flex items-center gap-2 tracking-[0.2em]">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            Push Deliverable Asset
                                        </h5>
                                        <form action="{{ route('editor.asset.upload', $task->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 relative z-10">
                                            @csrf
                                            <div class="flex-1">
                                                <input type="file" name="asset_file" required class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-2 text-xs file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#9d00ff] file:text-white cursor-pointer hover:border-white/30 transition-colors">
                                            </div>
                                            <button type="submit" class="bg-white text-black px-6 py-2.5 rounded-xl text-[10px] font-bold uppercase hover:bg-gray-200 transition-all shadow-lg shrink-0">Upload & Sync</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="xl:col-span-2 text-center py-24 border border-dashed border-white/10 rounded-[2rem] opacity-30">
                            <p class="font-mono text-sm uppercase tracking-[0.4em] text-gray-300">No Objectives Linked</p>
                            <p class="text-gray-500 text-xs mt-2 font-mono">Bekerja dengan damai. Menunggu direktif dari Admin.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 3: COMMS HUB -->
            <div id="tab-comms" class="tab-content h-full p-0 flex flex-col">
                <div class="flex-1 flex flex-col bg-transparent relative">
                    <!-- Chat Header -->
                    <div class="px-8 py-5 border-b border-white/10 bg-white/5 shrink-0 flex justify-between items-center backdrop-blur-md">
                        <div>
                            <p class="text-white text-base font-bold uppercase tracking-wide">Project Manager / Admin</p>
                            <span class="text-[10px] text-green-400 font-mono flex items-center gap-2 mt-1">
                                <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span> 
                                COORDINATION LINE CONNECTED
                            </span>
                        </div>
                        <div class="hidden md:block w-10 h-10 rounded-full border border-white/20 bg-white/10 flex items-center justify-center text-white font-bold">
                            PM
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar flex flex-col bg-[#05050a]/50">
                        @forelse($messages as $msg)
                            @php /** @var \App\Models\Message $msg */ @endphp
                            <div class="{{ $msg->sender_id === $authUser->id ? 'self-end bg-[#9d00ff] text-white shadow-[0_0_20px_rgba(157,0,255,0.2)]' : 'self-start bg-white/10 text-white border border-white/10' }} max-w-[85%] md:max-w-[70%] p-4 rounded-3xl {{ $msg->sender_id === $authUser->id ? 'rounded-tr-sm' : 'rounded-tl-sm' }}">
                                @if($msg->sender_id !== $authUser->id)
                                    <p class="text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Admin</p>
                                @endif
                                <p class="text-sm md:text-base leading-relaxed">{{ $msg->content }}</p>
                                <p class="text-[9px] opacity-60 mt-3 text-right font-mono">{{ $msg->created_at->format('H:i') }}</p>
                            </div>
                        @empty
                            <div class="flex-1 flex flex-col items-center justify-center opacity-20 text-center">
                                <svg class="w-12 h-12 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                <p class="text-[12px] font-mono uppercase tracking-[0.2em]">Node Idle</p>
                                <p class="text-[10px] text-gray-400 mt-2 font-mono">Laporkan kendala teknis atau progres Anda kepada Admin di sini.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Input Chat -->
                    <form action="{{ route('editor.chat.send') }}" method="POST" class="p-6 bg-[#05050a] border-t border-white/10 flex gap-4 shrink-0">
                        @csrf
                        <input type="text" name="message" required placeholder="Coordinate with PM..." class="w-full bg-white/5 border border-white/20 text-white text-sm rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#9d00ff] transition-colors">
                        <button type="submit" class="bg-[#9d00ff] text-white px-8 py-3.5 rounded-xl hover:bg-purple-600 transition-all font-bold uppercase text-xs tracking-widest flex items-center gap-2 shadow-[0_0_20px_rgba(157,0,255,0.3)]">
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
        
        let activeTabId = localStorage.getItem('editorActiveTab') || 'tab-tasks';
        if (hash === '#comms') activeTabId = 'tab-comms';

        function switchTab(targetId) {
            contents.forEach(c => c.classList.remove('active'));
            tabs.forEach(t => t.classList.remove('active'));

            const targetContent = document.getElementById(targetId);
            if(targetContent) targetContent.classList.add('active');

            const targetBtn = document.querySelector(`[data-target="${targetId}"]`);
            if(targetBtn) targetBtn.classList.add('active');

            localStorage.setItem('editorActiveTab', targetId);
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