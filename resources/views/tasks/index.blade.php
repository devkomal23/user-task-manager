@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Task List</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
</div>

<form action="{{ route('tasks.index') }}" method="GET" class="row g-3 mb-4">
    <div class="col-auto">
        <select name="status" class="form-select">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Filter</button>
    </div>
</form>

<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
            @php
                $isOverdue = $task->due_date < date('Y-m-d') && $task->status == 'pending';
            @endphp
            <tr class="{{ $isOverdue ? 'table-danger' : '' }}">
                <td><strong>{{ $task->title }}</strong></td>

                <td>{{ $task->user->name ?? 'Unassigned' }}</td>

                <td>
                    <span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </td>

                <td>
                    {{ $task->due_date }}
                    @if($isOverdue) 
                        <span class="badge bg-danger">OVERDUE</span> 
                    @endif
                </td>

                <td>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-end mt-3">
    {{ $tasks->appends(request()->query())->links() }}
</div>
@endsection