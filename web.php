<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.welcome')->name('welcome');
Route::view('/about', 'pages.about')->name('about');
Route::view('/profile', 'pages.profile')->name('profile');

Route::resource('tasks', TaskController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
