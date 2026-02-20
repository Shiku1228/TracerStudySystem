<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request and redirect based on user role.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return match($user->role) {
            'admin' => view('admin-dashboard'),
            'student' => view('student-dashboard'),
            default => view('dashboard'),
        };
    }
}
