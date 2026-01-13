<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
Route::get('/', [UserController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
// Change this:
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// To this:
Route::resource('tasks', TaskController::class);Route::get('/api/users/{id}/tasks', [TaskController::class, 'getUserTasks']);