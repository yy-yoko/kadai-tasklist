<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController; 

Route::get('/', [TasksController::class, 'index']);

//Route::put('/tasks/{task}', [TasksController::class, 'update'])->middleware(['auth'])->name('tasks.update');

Route::group(['middleware' => ['auth']], function () {                                    
    Route::get('/dashboard', [TasksController::class, 'index'])->name('dashboard');
    //Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    //Route::get('/tasks/{id}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    //Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
    //Route::resource('tasks', TasksController::class, ['only' => ['index', 'show','store','destroy']]);
    Route::resource('tasks', TasksController::class);
});                                                                                       

require __DIR__.'/auth.php';                                             