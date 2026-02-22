<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';

Route::get('/test-role', function () {
    return 'Middleware is working!';
})->middleware(['auth', 'role:admin']);

Route::get('/admin-dashboard', function () {
    return 'Welcome to the admin dashboard!';
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/student-dashboard', function () {
    return 'Welcome to the student dashboard!';
})->middleware(['auth', 'role:student'])->name('student.dashboard');

Route::get('/alumni/register', \App\Livewire\AlumniForm::class)
    ->middleware(['auth'])
    ->name('alumni.register');