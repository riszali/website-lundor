<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Message;
use App\Models\ProjectRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $authUser = Auth::user();
        
        $query = Project::with(['client', 'tasks']);
        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }
        $projects = $query->orderBy('created_at', 'desc')->get();
        
        $newRequests = ProjectRequest::with('client')->where('status', 'pending')->latest()->get();
        $editors = User::where('role', 'artist')->get();
        $pendingAssets = Task::with(['project', 'editor'])->where('status', 'completed')->latest()->get(); 
        
        $chatUsers = User::whereIn('role', ['client', 'artist'])->orderBy('role')->get();
        $messages = collect();
        $activeChatUser = null;

        if ($request->has('chat_with')) {
            $activeChatUser = User::find($request->chat_with);
            if ($activeChatUser) {
                $messages = Message::with('sender')
                    ->where(function($q) use ($activeChatUser, $authUser) {
                        $q->where('sender_id', $authUser->id)->where('receiver_id', $activeChatUser->id);
                    })
                    ->orWhere(function($q) use ($activeChatUser, $authUser) {
                        $q->where('sender_id', $activeChatUser->id)->where('receiver_id', $authUser->id);
                    })->orderBy('created_at', 'asc')->get();
            }
        }

        return view('pages.admin-dashboard', compact('authUser', 'projects', 'newRequests', 'editors', 'chatUsers', 'messages', 'pendingAssets', 'activeChatUser'));
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6', 
            'role' => 'required|in:admin,client,artist'
        ]);

        User::create([
            'name' => $validated['name'], 
            'email' => $validated['email'], 
            'password' => Hash::make($validated['password']), 
            'role' => $validated['role']
        ]);

        return back()->with('success', 'Entitas ' . strtoupper($validated['role']) . ' berhasil diregistrasi.');
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

        return back()->with('success', 'Proposal diotorisasi. Proyek baru aktif di Pipeline.');
    }

    public function assignTask(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id', 
            'editor_id' => 'required|exists:users,id', 
            'title' => 'required|string|max:255', 
            'priority' => 'required|in:normal,high', 
            'due_date' => 'required|date|after_or_equal:today'
        ]);

        Task::create($validated);
        return back()->with('success', 'Direktif teknis berhasil ditransmisikan ke Editor.');
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
            return back()->with('success', 'QC Lolos. Aset telah disiapkan untuk klien.'); 
        } 
        
        $task->update(['status' => 'in_progress', 'title' => '[REVISI QC] - ' . $task->title]);
        return back()->with('error', 'Aset ditolak. Dikembalikan ke Editor untuk perbaikan.');
    }

    public function createBlog(Request $request) 
    { 
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        return back()->with('success', 'Insight Agensi berhasil dipublikasikan.'); 
    }

    public function sendChat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
            'receiver_id' => 'required|exists:users,id'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'content' => $validated['message']
        ]);

        return back();
    }
}