<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function index(Request $request) {
        $query = Task::with('user');

        // 2. Apply the filter ONLY if a status is selected
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Paginate the $query (Don't use Task::with again)
        $tasks = $query->paginate(2); 

        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

   public function store(Request $request) {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date|after_or_equal:today',
            'status'      => 'required|in:pending,completed', // This requires the field in HTML
        ]);

        // Use $request->all() only after validation passes
        Task::create($request->all());
        
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
        public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function getUserTasks($id)
    {
        // 1. Find the user or return 404 if missing
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // 2. Fetch the tasks using the relationship
        $tasks = $user->tasks;

        // 3. Return as JSON (No View involved)
        return response()->json([
            'status' => 'success',
            'user_name' => $user->name,
            'data' => $tasks
        ], 200);
    }
}