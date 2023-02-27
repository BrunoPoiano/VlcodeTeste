<?php

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('logged-user', function() {
        return Auth::user();
    })->name('logged.user');
});

Route::middleware('auth')->prefix('todo')->group(function () {
    Route::get('', [TodoController::class, 'listToDos'])->name('todo.list');
    Route::post('', [TodoController::class, 'createTodo'])->name('todo.create');
   
    Route::prefix('{todo}')->group(function () {
        Route::put('{status}', [TodoController::class, 'updateTodo'])->name('todo.update');
        Route::delete('', [TodoController::class, 'deleteTodo'])->name('todo.delete');
    });
});

Route::middleware('auth')->prefix('users')->group(function () {
    Route::get('list', [UserController::class, 'listUsers'])->name('users.list');

});

require __DIR__.'/auth.php';
