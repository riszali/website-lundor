<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Message;
use App\Models\ProjectRequest;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        
        $clientProjects = Project::where('client_id', $authUser->id)->orderBy('created_at', 'desc')->get();
        $projectIds = $clientProjects->pluck('id');
        
        $assetsForReview = Task::with('project')
                            ->whereIn('project_id', $projectIds)
                            ->where('status', 'completed')
                            ->latest()->get();
        
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : null;
        
        $messages = collect();
        if ($adminId) {
            $messages = Message::with('sender')
                ->where(function($q) use ($adminId, $authUser) {
                    $q->where('sender_id', $authUser->id)->where('receiver_id', $adminId);
                })
                ->orWhere(function($q) use ($adminId, $authUser) {
                    $q->where('sender_id', $adminId)->where('receiver_id', $authUser->id);
                })->orderBy('created_at', 'asc')->get();
        }

        return view('pages.client-dashboard', compact('authUser', 'clientProjects', 'messages', 'assetsForReview'));
    }

    public function requestProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        ProjectRequest::create([
            'client_id' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Proposal terkirim ke HQ Agensi. Kami akan segera merespons.');
    }

    public function assetFeedback($id, Request $request) 
    { 
        $validated = $request->validate([
            'feedback' => 'required|in:approve,revision',
            'notes' => 'nullable|string|max:1000'
        ]);

        $task = Task::findOrFail($id);

        if ($validated['feedback'] === 'revision') {
            Task::create([
                'project_id' => $task->project_id,
                'editor_id' => $task->editor_id, 
                'title' => '[CLIENT REVISION] ' . $task->title,
                'priority' => 'high', 
                'status' => 'pending',
                'due_date' => Carbon::now()->addDays(2)->format('Y-m-d') 
            ]);
            return back()->with('success', 'Catatan revisi diteruskan ke tim eksekusi teknis.');
        }

        $project = Project::find($task->project_id);
        if ($project && $project->progress < 100) {
             $project->update(['progress' => 100]); 
        }

        return back()->with('success', 'Aset final disetujui. Terima kasih atas kolaborasi Anda.'); 
    }

    public function sendChat(Request $request)
    {
        $validated = $request->validate(['message' => 'required|string|max:2000']);
        
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            return back()->with('error', 'HQ Offline. Admin tidak ditemukan.');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $admin->id,
            'content' => $validated['message']
        ]);

        return back();
    }
}