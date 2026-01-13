@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-primary text-white">Create New Task</div>
    <div class="card-body">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Assigned User</label>
                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Task Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    class="form-control @error('description') is-invalid @enderror" 
                    placeholder="Describe the details of the task...">{{ old('description') }}</textarea>
                
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" min="{{ date('Y-m-d') }}">
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
             @endif
            <button class="btn btn-success w-100">Save Task</button>
        </form>
    </div>
</div>
@endsection