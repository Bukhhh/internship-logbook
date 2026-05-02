<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternLog;
use Illuminate\Support\Facades\Auth;

class InternLogController extends Controller{

    public function index()
    {
        // ONLY fetch logs that belong to the logged-in user!
        $logs = InternLog::where('user_id', Auth::id())->get();
        return view('logs.index', compact('logs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'details' => 'required|string',
            'log_date' => 'required|date',
            'status' => 'required|in:ongoing,completed,stuck',
            'supervisor_remarks' => 'nullable|string', // <-- Add this validation
        ]);

        InternLog::create([
            'user_id' => Auth::id(),
            'task_name' => $request->task_name,
            'details' => $request->details,
            'log_date' => $request->log_date,
            'status' => $request->status,
            'supervisor_remarks' => $request->supervisor_remarks, // <-- Save it to DB
        ]);

        return redirect('/logs');
    }

    public function destroy($id)
    {
        // 1. Find the specific log in the database using the ID from the URL
        $log = InternLog::findOrFail($id);

        // 2. Destroy it!
        $log->delete();

        // 3. Refresh the page so the user sees the updated list
        return redirect('/logs');
    }

    public function edit($id)
    {
        // 1. Find the exact log they want to edit
        $log = InternLog::findOrFail($id);

        // 2. Send them to a new 'edit' view, and pass the data along
        return view('logs.edit', ['log' => $log]);
    }

    public function update(Request $request, $id)
    {
        // 1. Find the exact log in the database
        $log = InternLog::findOrFail($id);

        // 2. Overwrite the old data with the new data from the form
        $log->update([
            'task_name' => $request->task_name,
            'details' => $request->details,
            'log_date' => $request->log_date,
            'status' => $request->status,
        ]);

        // 3. Send the user back to the main logbook page
        return redirect('/logs');
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Find the exact log
        $log = InternLog::findOrFail($id);

        // 2. Update just the status
        $log->update([
            'status' => $request->status
        ]);

        // 3. Send a "Thumbs Up" JSON response back to the browser
        return response()->json(['success' => true]);
    }

    
}
