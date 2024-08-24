<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('task')->name('task.')->group(function () {
        Route::get('create', [TaskController::class, 'create'])->name('create');
        Route::post('task', [TaskController::class, 'store'])->name('store');
        Route::get('{task}', [TaskController::class, 'edit'])->name('edit');
        Route::put('{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('{task}', [TaskController::class, 'destroy'])->name('delete');
    });
});

require __DIR__.'/auth.php';
