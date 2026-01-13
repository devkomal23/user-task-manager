@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-warning">Edit Task</div>
    <div class="card-body">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Assigned User</label>
                <select name="user_id" class="form-select">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $task->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="pending" {{ old('status', $task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}" min="{{ date('Y-m-d') }}">
            </div>

            <button class="btn btn-primary w-100">Update Task</button>
        </form>
    </div>
</div>
@endsection