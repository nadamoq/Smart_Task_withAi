<?php

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

    Route::put('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

});
