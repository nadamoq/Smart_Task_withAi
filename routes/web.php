<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\AiTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskAiController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::get('/dashboard', function () {
    return view('tasks.index');

})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    
    Route::resource('/tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('projects/{project}/sprints', [ProjectController::class, 'sprints'])->name('projects.sprints');
    Route::put('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    
    Route::prefix('ai')->group(function () {
        Route::get('/', [TaskAiController::class, 'index'])->name('ai.index');
        Route::post('/breakdown', [TaskAiController::class, 'breakdown'])->name('ai.breakdown');
        // Route::post('/backlog', [AiTaskController::class, 'backlog'])->name('ai.backlog');
        Route::post('/save-tasks', [TaskAiController::class, 'importTasks'])->name('ai.save-tasks');
   // مسارات الـ Backlog (تمت إضافتها)
        Route::post('/backlog', [TaskAiController::class, 'backlog'])->name('ai.backlog');
        
        // المسار الجديد للحفظ الذي صممناه للـ Backlog
        Route::post('/save-backlog', [TaskAiController::class, 'importBacklog'])->name('ai.import-backlog');
        });

});
