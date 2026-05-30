<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\TracerBatch;
use App\Models\Respondent;
use App\Models\EmploymentData;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Component
{
    public $totalUsers;
    public $totalUploads;
    public $totalReports;
    public $recentActivity;
    // Analytics properties
    public $totalRespondents;
    public $courseDistribution = [];
    public $graduationData = [];
    public $genderDistribution = [];
    public $civilStatusDistribution = [];
    public $workAlignmentData = [];
    public $employmentStats = [];

    public function mount()
    {
        $this->refreshData();
        $this->loadAnalytics();
    }

    public function refreshData()
    {
        // Get total users
        $this->totalUsers = User::count();

        // Get total uploads/batches
        $this->totalUploads = TracerBatch::count();

        // Get total respondents (as reports)
        $this->totalReports = $this->getTotalReports();

        // Get recent activity
        $this->recentActivity = $this->getRecentActivity();
    }

    private function getTotalReports()
    {
        // Count total respondents as processed records
        return Respondent::count();
    }

    private function getRecentActivity()
    {
        $activities = [];

        // Get recent uploads
        $recentUploads = TracerBatch::with('admin')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        foreach ($recentUploads as $upload) {
            $activities[] = [
                'type' => 'upload',
                'title' => 'New batch uploaded',
                'description' => $upload->batch_name,
                'user' => $upload->admin->name ?? 'System',
                'time' => $upload->created_at->diffForHumans(),
                'icon' => 'upload',
                'color' => 'blue'
            ];
        }

        // Get recent respondents (as "reports")
        $recentRespondents = Respondent::with('batch')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($recentRespondents as $respondent) {
            $activities[] = [
                'type' => 'report',
                'title' => 'New respondent added',
                'description' => $respondent->full_name,
                'user' => 'System',
                'time' => $respondent->created_at->diffForHumans(),
                'icon' => 'document',
                'color' => 'red'
            ];
        }

        // Get recent user registrations
        $recentUsers = User::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($recentUsers as $user) {
            $activities[] = [
                'type' => 'user',
                'title' => 'New user registered',
                'description' => $user->name,
                'user' => 'System',
                'time' => $user->created_at->diffForHumans(),
                'icon' => 'user',
                'color' => 'purple'
            ];
        }

        // Sort by time and take latest 5
        usort($activities, function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 5);
    }


    /**
     * Load analytics data used by the charts on the admin dashboard.
     */
    private function loadAnalytics()
    {
        // Total respondents
        $this->totalRespondents = Respondent::count();

        // Course distribution
        $courseData = Respondent::select('course_graduated', DB::raw('count(*) as count'))
            ->groupBy('course_graduated')
            ->orderByDesc('count')
            ->take(20)
            ->get();
        $this->courseDistribution = $courseData->pluck('count', 'course_graduated')->toArray();

        // Graduation per year data
        $graduationData = Respondent::select('graduation_year', DB::raw('count(*) as count'))
            ->groupBy('graduation_year')
            ->orderBy('graduation_year')
            ->get();
        $this->graduationData = $graduationData->pluck('count', 'graduation_year')->toArray();

        // Gender distribution
        $genderData = Respondent::select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->orderByDesc('count')
            ->get();
        $this->genderDistribution = $genderData->pluck('count', 'gender')->toArray();

        // Civil status distribution
        $civilStatusData = Respondent::select('civil_status', DB::raw('count(*) as count'))
            ->groupBy('civil_status')
            ->orderByDesc('count')
            ->get();
        $this->civilStatusDistribution = $civilStatusData->pluck('count', 'civil_status')->toArray();

        // Work/course alignment distribution - query from EmploymentData table
        $alignmentData = EmploymentData::select('is_course_related', DB::raw('count(*) as count'))
            ->whereNotNull('is_course_related')
            ->groupBy('is_course_related')
            ->get();

        $aligned = $alignmentData->where('is_course_related', true)->first()?->count ?? 0;
        $notAligned = $alignmentData->where('is_course_related', false)->first()?->count ?? 0;
        $totalWithAlignmentData = $aligned + $notAligned;

        $this->workAlignmentData = [
            'aligned' => $aligned,
            'not_aligned' => $notAligned,
            'aligned_percentage' => $totalWithAlignmentData > 0 ? round(($aligned / $totalWithAlignmentData) * 100, 1) : 0,
            'not_aligned_percentage' => $totalWithAlignmentData > 0 ? round(($notAligned / $totalWithAlignmentData) * 100, 1) : 0,
            'total_responded' => $totalWithAlignmentData,
        ];

        // Employment statistics come from the imported employment_data answers.
        $employmentQuery = EmploymentData::query();
        $employedCount = (clone $employmentQuery)->where('is_presently_employed', true)->count();
        $nonEmployedCount = (clone $employmentQuery)->where('is_presently_employed', false)->count();
        $employedWithCourseRelated = (clone $employmentQuery)
            ->where('is_presently_employed', true)
            ->where('is_course_related', true)
            ->count();

        $totalEmploymentResponses = $employedCount + $nonEmployedCount;

        $this->employmentStats = [
            'total_respondents' => $this->totalRespondents,
            'employed' => $employedCount,
            'non_employed' => $nonEmployedCount,
            'employed_with_course_related' => $employedWithCourseRelated,
            'employed_percentage' => $this->totalRespondents > 0 ? round(($employedCount / $this->totalRespondents) * 100, 1) : 0,
            'non_employed_percentage' => $this->totalRespondents > 0 ? round(($nonEmployedCount / $this->totalRespondents) * 100, 1) : 0,
            'course_related_percentage' => $employedCount > 0 ? round(($employedWithCourseRelated / $employedCount) * 100, 1) : 0,
            'responded_percentage' => $this->totalRespondents > 0 ? round(($totalEmploymentResponses / $this->totalRespondents) * 100, 1) : 0,
        ];
    }


    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
