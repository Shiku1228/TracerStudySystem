<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin-only routes for Tracer Study Analytics System
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', \App\Livewire\AdminDashboard::class)->name('dashboard');
    Route::get('/analytics', \App\Http\Controllers\DashboardController::class)->name('analytics');
    Route::get('/upload', \App\Livewire\ExcelUpload::class)->name('upload');
    Route::get('/reports', function () {
        return view('reports', ['livewire' => \App\Livewire\UnifiedReportsDashboard::class]);
    })->name('reports');
    
    // Respondent Directory routes
    Route::get('/respondents', [\App\Http\Controllers\RespondentController::class, 'index'])->name('respondents.index');
    Route::get('/respondents/{respondent}', [\App\Http\Controllers\RespondentController::class, 'show'])->name('respondents.show');
    
    // User Management routes
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
});

Route::get('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

require __DIR__.'/settings.php';