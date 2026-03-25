<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Message;
use App\Models\ProjectRequest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /* =========================================================================
       BAGIAN 1: SISTEM TAMPILAN DASHBOARD (READ / GET DATA)
       Dirancang khusus untuk alur kerja (Pipeline) sebuah Digital Agency.
       ========================================================================= */
    
    /**
     * DASHBOARD ADMIN (PROJECT MANAGER)
     */
    public function admin(Request $request)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();
        if ($authUser->role !== 'admin') abort(403, 'Akses Ditolak. Hanya untuk Root Administrator.');
        
        // 2. Filter Divisi Proyek (100% DINAMIS - Tanpa hardcoding kategori)
        $category = $request->query('category');
        $query = Project::with(['client', 'tasks']);
        
        // Jika ada filter kategori, terapkan langsung tanpa membatasi tipe layanannya
        if ($category) {
            $query->where('category', $category);
        }
        $projects = $query->orderBy('created_at', 'desc')->get();
        
        // 3. Data Operasional
        $newRequests = ProjectRequest::with('client')->where('status', 'pending')->latest()->get();
        $editors = User::where('role', 'artist')->get();
        
        // 4. Sistem Quality Control (QC) Internal
        $pendingAssets = Task::with(['project', 'editor'])
                            ->where('status', 'completed')
                            ->latest()->get(); 

        // 5. Hub Komunikasi Sentral
        $chatUsers = User::whereIn('role', ['client', 'artist'])->orderBy('role')->get();
        $messages = collect();
        $activeChatUser = null; // Disiapkan di Controller agar IDE tidak membaca 'void'

        if ($request->has('chat_with')) {
            $chatWith = $request->chat_with;
            $activeChatUser = User::find($chatWith);
            
            $messages = Message::with('sender')
                ->where(function($q) use ($chatWith, $authUser) {
                    $q->where('sender_id', $authUser->id)->where('receiver_id', $chatWith);
                })
                ->orWhere(function($q) use ($chatWith, $authUser) {
                    $q->where('sender_id', $chatWith)->where('receiver_id', $authUser->id);
                })->orderBy('created_at', 'asc')->get();
        }

        // Meneruskan variabel `$authUser` dan `$activeChatUser` ke view untuk mencegah warning PHP0407
        return view('pages.admin-dashboard', compact('authUser', 'projects', 'newRequests', 'editors', 'chatUsers', 'messages', 'pendingAssets', 'activeChatUser'));
    }

    /**
     * DASHBOARD CLIENT (PARTNER)
     */
    public function client(Request $request)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();
        if ($authUser->role !== 'client') abort(403, 'Akses Ditolak. Halaman khusus Partner.');
        
        $clientProjects = Project::where('client_id', $authUser->id)->orderBy('created_at', 'desc')->get();
        
        $projectIds = $clientProjects->pluck('id');
        $assetsForReview = Task::with('project')
                            ->whereIn('project_id', $projectIds)
                            ->where('status', 'completed')
                            ->latest()->get();
        
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : null;
        $messages = $this->fetchMessages($adminId, $authUser->id);

        return view('pages.client-dashboard', compact('authUser', 'clientProjects', 'messages', 'assetsForReview'));
    }

    /**
     * DASHBOARD EDITOR (ARTIST)
     */
    public function editor(Request $request)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();
        if ($authUser->role !== 'artist') abort(403, 'Akses Ditolak. Halaman khusus Creative Node.');
        
        // MENGGUNAKAN CASE WHEN AGAR SUPPORT SQLITE / SEMUA DATABASE (Mencegah Error 500)
        $tasks = Task::with('project')
                    ->where('editor_id', $authUser->id)
                    ->orderByRaw("CASE 
                        WHEN status = 'in_progress' THEN 1 
                        WHEN status = 'pending' THEN 2 
                        WHEN status = 'completed' THEN 3 
                        ELSE 4 END") 
                    ->orderBy('due_date', 'asc')
                    ->get();
        
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : null;
        $messages = $this->fetchMessages($adminId, $authUser->id);

        return view('pages.editor-dashboard', compact('authUser', 'tasks', 'messages'));
    }


    /* =========================================================================
       BAGIAN 2: LOGIKA PROSES BISNIS (POST / PATCH / AKSI SISTEM)
       Eksekusi data berdasarkan input form dari masing-masing Role.
       ========================================================================= */
    
    // --- AKSI ADMIN ---

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6', 
            'role' => 'required|in:admin,client,artist'
        ]);

        User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'role' => $request->role
        ]);

        return back()->with('success', 'Entitas ' . strtoupper($request->role) . ' baru berhasil diinisialisasi ke dalam jaringan.');
    }

    public function approveRequest($id)
    {
        $req = ProjectRequest::findOrFail($id);
        $req->update(['status' => 'approved']);
        
        Project::create([
            'client_id' => $req->client_id,
            'name' => $req->title,
            'category' => $req->category,
            'description' => $req->description,
            'progress' => 5 
        ]);

        return back()->with('success', 'Proposal disetujui. Pipeline proyek baru telah dibuat dan siap dieksekusi.');
    }

    public function assignTask(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id', 
            'editor_id' => 'required|exists:users,id', 
            'title' => 'required|string|max:255', 
            'priority' => 'required|in:normal,high', 
            'due_date' => 'required|date|after_or_equal:today'
        ]);

        Task::create($request->all());

        return back()->with('success', 'Direktif teknis berhasil ditransmisikan ke Node Editor terkait.');
    }

    public function reviewAsset($id, Request $request) 
    { 
        $request->validate(['action' => 'required|in:approve,reject']);
        $task = Task::findOrFail($id);
        
        if ($request->action === 'approve') {
            $project = Project::find($task->project_id);
            if ($project) {
                $project->update(['progress' => min(100, $project->progress + 25)]); 
            }
            return back()->with('success', 'QC Lolos. Aset telah diteruskan ke portal Klien.'); 
        } else {
            $task->update(['status' => 'in_progress', 'title' => '[REVISI QC] - ' . $task->title]);
            return back()->with('error', 'Aset ditolak. Tugas telah dikembalikan ke pipeline Editor untuk perbaikan.');
        }
    }

    public function createBlog(Request $request) 
    { 
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        return back()->with('success', 'Insight Agensi berhasil dipublikasikan.'); 
    }


    // --- AKSI CLIENT ---

    public function requestProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        ProjectRequest::create([
            'client_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Proposal proyek Anda telah terkirim dengan aman ke HQ Agensi. PM kami akan segera merespons.');
    }

    public function assetFeedback($id, Request $request) 
    { 
        $request->validate([
            'feedback' => 'required|in:approve,revision',
            'notes' => 'nullable|string|max:1000'
        ]);

        $task = Task::findOrFail($id);

        if ($request->feedback === 'revision') {
            Task::create([
                'project_id' => $task->project_id,
                'editor_id' => $task->editor_id, 
                'title' => '[CLIENT REVISION] ' . $task->title,
                'priority' => 'high', 
                'status' => 'pending',
                'due_date' => Carbon::now()->addDays(2)->format('Y-m-d') 
            ]);
            return back()->with('success', 'Permintaan revisi telah diteruskan ke tim eksekusi terkait.');
        }

        $project = Project::find($task->project_id);
        if ($project && $project->progress < 100) {
             $project->update(['progress' => 100]); 
        }

        return back()->with('success', 'Aset disetujui! Terima kasih atas kolaborasi Anda.'); 
    }


    // --- AKSI EDITOR ---

    public function updateTask($id, Request $request)
    {
        $request->validate(['status' => 'required|in:pending,in_progress,completed']);
        $task = Task::findOrFail($id);
        
        if($task->editor_id !== Auth::id()) abort(403, 'Akses Ilegal.');
        
        $task->update(['status' => $request->status]);
        
        return back()->with('success', 'Status operasional tugas berhasil diperbarui menjadi: ' . strtoupper($request->status));
    }

    public function uploadAsset(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id', 
            'asset_file' => 'required|file|max:51200' 
        ]);

        $task = Task::findOrFail($request->task_id);
        if($task->editor_id !== Auth::id()) abort(403);
        
        if ($request->hasFile('asset_file')) {
            $file = $request->file('asset_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/deliverables'), $filename);
            
            $task->update(['status' => 'completed']);
        }

        return back()->with('success', 'Deliverable final berhasil di-push ke server. Menunggu validasi QC dari Admin.');
    }

    public function viewTask($id) 
    { 
        return back()->with('success', 'Mengakses dokumen brief mendetail untuk Tugas ID: ' . $id); 
    }


    /* =========================================================================
       BAGIAN 3: SISTEM KOMUNIKASI (MESSAGING HUB)
       ========================================================================= */

    public function sendChat(Request $request)
    {
        $request->validate(['message' => 'required|string|max:2000']);
        $receiverId = $request->receiver_id;

        if (!$receiverId && Auth::user()->role !== 'admin') {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $receiverId = $admin->id;
            } else {
                return back()->with('error', 'Koneksi Gagal: Root Administrator tidak terdeteksi di jaringan.');
            }
        }

        if (!$receiverId) {
            return back()->with('error', 'Koneksi Gagal: Target penerima tidak valid.');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'content' => $request->message
        ]);

        return back();
    }

    private function fetchMessages($targetUserId, $authUserId)
    {
        if (!$targetUserId) return collect();

        return Message::with('sender')
            ->where(function($q) use ($targetUserId, $authUserId) {
                $q->where('sender_id', $authUserId)->where('receiver_id', $targetUserId);
            })
            ->orWhere(function($q) use ($targetUserId, $authUserId) {
                $q->where('sender_id', $targetUserId)->where('receiver_id', $authUserId);
            })->orderBy('created_at', 'asc')->get();
    }
}