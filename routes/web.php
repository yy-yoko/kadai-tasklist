<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']],function () {
Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
});
Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');


require __DIR__.'/auth.php';
