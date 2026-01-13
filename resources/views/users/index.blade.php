@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Add New User</div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}">
                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add User</button>
                </form>
            </div>
        </div>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100 shadow-sm">
            <i class="bi bi-list-check"></i> View All Tasks
        </a>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>User List</span>
                <span class="badge bg-secondary">{{ $users->count() }} Total Users</span>
            </div>
            <div class="card-body p-0"> <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Tasks (Total/Done)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                <strong>{{ $user->name }}</strong><br>
                                <small class="text-muted">{{ $user->email }} | {{ $user->mobile }}</small>
                            </td>
                            <td>
                                <a href="{{ route('tasks.index', ['user_id' => $user->id]) }}" class="text-decoration-none">
                                    <span class="badge bg-info text-dark" title="Total Tasks">{{ $user->tasks_count }}</span>
                                    <span class="badge bg-success" title="Completed Tasks">{{ $user->completed_tasks_count }}</span>
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('tasks.create', ['user_id' => $user->id]) }}" class="btn btn-sm btn-outline-success" title="Add Task">+ Task</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection