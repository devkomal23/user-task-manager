<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // List Users with Task counts (Requirement Part 4)
    public function index() {
        $users = User::withCount(['tasks', 'tasks as completed_tasks_count' => function($query) {
            $query->where('status', 'completed');
        }])->get();
        return view('users.index', compact('users'));
    }
    
    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|digits:10', // Requirement: 10 digits
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}