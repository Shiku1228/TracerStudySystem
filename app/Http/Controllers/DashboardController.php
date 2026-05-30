<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use App\Models\EmploymentData;
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

        // Aggregate Analytics Data
        $total = Respondent::count();
        
        // Count based on the relationship used in RespondentController
        $employedCount = Respondent::whereHas('employmentData', function ($query) {
            $query->where('is_presently_employed', true);
        })->count();
        
        $employmentRate = $total > 0 ? round(($employedCount / $total) * 100, 1) : 0;
        
        // Calculate average salary from employment data
        $avgSalary = EmploymentData::avg('monthly_income') ?? 0;
        
        $alignmentCount = Respondent::whereHas('employmentData', function ($query) {
            $query->where('is_course_related', true);
        })->count();
        
        $alignmentRate = $total > 0 ? round(($alignmentCount / $total) * 100, 1) : 0;

        // Data for Charts
        $employmentStats = collect([
            ['employment_status' => 'Employed', 'count' => $employedCount],
            ['employment_status' => 'Unemployed', 'count' => $total - $employedCount],
        ]);

        $data = compact('total', 'employmentRate', 'avgSalary', 'alignmentRate', 'employmentStats');

        return view('dashboard', $data);
    }
}
