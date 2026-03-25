<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Message;

class EditorController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        
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

        return view('pages.editor-dashboard', compact('authUser', 'tasks', 'messages'));
    }

    public function viewTask($id) 
    { 
        $task = Task::findOrFail($id);
        if($task->editor_id !== Auth::id()) abort(403);
        
        return back()->with('success', 'Mengakses dokumen brief mendetail untuk Tugas: ' . $task->title); 
    }

    public function updateTask($id, Request $request)
    {
        $validated = $request->validate(['status' => 'required|in:pending,in_progress,completed']);
        $task = Task::findOrFail($id);
        
        if($task->editor_id !== Auth::id()) abort(403, 'Akses Ilegal.');
        
        $task->update(['status' => $validated['status']]);
        
        return back()->with('success', 'Status operasional tugas: ' . strtoupper($validated['status']));
    }

    public function uploadAsset($id, Request $request)
    {
        $validated = $request->validate([
            'asset_file' => 'required|file|max:51200' 
        ]);

        $task = Task::findOrFail($id);
        if($task->editor_id !== Auth::id()) abort(403, 'Akses Ilegal.');
        
        if ($request->hasFile('asset_file')) {
            $file = $request->file('asset_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            
            $file->move(public_path('uploads/deliverables'), $filename);
            $task->update(['status' => 'completed']);
        }

        return back()->with('success', 'Deliverable di-push ke server. Menunggu QC Admin.');
    }

    public function sendChat(Request $request)
    {
        $validated = $request->validate(['message' => 'required|string|max:2000']);
        
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            return back()->with('error', 'PM Offline. Admin tidak ditemukan.');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $admin->id,
            'content' => $validated['message']
        ]);

        return back();
    }
}