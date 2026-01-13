<form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title">Task Title</label>
        <input type="text" name="title" 
               class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title', $task->title ?? '') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" 
               class="form-control @error('due_date') is-invalid @enderror" 
               value="{{ old('due_date', $task->due_date ?? '') }}" required>
        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($task) ? 'Update Task' : 'Create Task' }}
    </button>
</form>