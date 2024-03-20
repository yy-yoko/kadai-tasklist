<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController; 

Route::get('/', [TasksController::class, 'index']);
Route::get('/dashboard', [TasksController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {                                    
    Route::resource('tasks', TasksController::class);
});                                                                                       

require __DIR__.'/auth.php';                                             