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
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        @php
            $isOverdue = $task->due_date < date('Y-m-d') && $task->status == 'pending';
        @endphp
        <tr class="{{ $isOverdue ? 'table-danger' : '' }}">
            <td>{{ $task->title }}</td>
            <td>{{ Str::limit($task->description, 30) }}</td> <td>
                <span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                     {{ ucfirst($task->status) }}
                </span>
             </td>
            <td>{{ $task->user->name }}</td>
            <td>
                {{ $task->due_date }}
                @if($isOverdue) <span class="badge bg-danger">OVERDUE</span> @endif
            </td>
            <td>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end mt-3">
    {{ $tasks->links() }}
</div>
@endsection