<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use App\Models\EmploymentData;
use Illuminate\Http\Request;

class RespondentController extends Controller
{
    public function index()
    {
        return view('respondents.index');
    }

    public function show(Respondent $respondent)
    {
        // Load employment data and batch information
        $respondent->load(['employmentData', 'batch']);
        
        return view('respondents.show', compact('respondent'));
    }

    public function search(Request $request)
    {
        $query = Respondent::with(['employmentData', 'batch']);

        // Search by name
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('full_name', 'LIKE', "%{$searchTerm}%");
        }

        // Filter by course
        if ($request->filled('course')) {
            $query->where('course_graduated', $request->input('course'));
        }

        // Filter by graduation year
        if ($request->filled('graduation_year')) {
            $query->where('graduation_year', $request->input('graduation_year'));
        }

        // Filter by employment status
        if ($request->filled('employment_status')) {
            $status = $request->input('employment_status');
            $query->whereHas('employmentData', function($q) use ($status) {
                if ($status === 'employed') {
                    $q->where('is_presently_employed', true);
                } elseif ($status === 'unemployed') {
                    $q->where('is_presently_employed', false);
                }
            });
        }

        // Filter by work location
        if ($request->filled('work_location')) {
            $location = $request->input('work_location');
            $query->whereHas('employmentData', function($q) use ($location) {
                $q->where('place_of_work', $location);
            });
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // Filter by civil status
        if ($request->filled('civil_status')) {
            $query->where('civil_status', $request->input('civil_status'));
        }

        // Filter by batch
        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->input('batch_id'));
        }

        // Order by latest graduation year or name
        $sortBy = $request->input('sort_by', 'graduation_year');
        $sortOrder = $request->input('sort_order', 'desc');
        
        if (in_array($sortBy, ['full_name', 'graduation_year', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $respondents = $query->paginate(10);

        return response()->json($respondents);
    }

    public function getFilters()
    {
        $courses = Respondent::distinct('course_graduated')->pluck('course_graduated')->filter();
        $years = Respondent::distinct('graduation_year')->orderBy('graduation_year', 'desc')->pluck('graduation_year')->filter();
        $genders = Respondent::distinct('gender')->pluck('gender')->filter();
        $civilStatuses = Respondent::distinct('civil_status')->pluck('civil_status')->filter();
        $batches = \App\Models\TracerBatch::orderBy('created_at', 'desc')->get(['id', 'batch_name']);

        return response()->json([
            'courses' => $courses,
            'years' => $years,
            'genders' => $genders,
            'civil_statuses' => $civilStatuses,
            'batches' => $batches
        ]);
    }
}
