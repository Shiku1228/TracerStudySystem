<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Respondent;
use App\Models\EmploymentData;
use App\Models\TracerBatch;

class UnifiedReportsDashboard extends Component
{
    public $selectedBatch = '';
    public $reportType = 'summary';
    public $batches;
    public $reportData = [];

    // Analytics properties
    public $totalRespondents = 0;
    public $employmentRate = 0;
    public $averageSalary = 0;
    public $courseRelevance = 0;
    public $salaryDistribution = [];
    public $employmentByIndustry = [];
    public $courseDistribution = [];

    public function mount()
    {
        $this->batches = TracerBatch::orderBy('created_at', 'desc')->get();
        $this->loadAnalyticsData();
        $this->generateReport();
    }

    public function updatedSelectedBatch()
    {
        $this->loadAnalyticsData();
        $this->generateReport();
    }

    public function updatedReportType()
    {
        $this->generateReport();
    }

    private function loadAnalyticsData()
    {
        $query = Respondent::with('employmentData');
        
        if ($this->selectedBatch) {
            $query->where('batch_id', $this->selectedBatch);
        }

        $respondents = $query->get();
        $this->totalRespondents = $respondents->count();

        if ($this->totalRespondents > 0) {
            // Employment Rate
            $employedCount = $respondents->whereHas('employmentData', function($q) {
                $q->where('is_presently_employed', true);
            })->count();
            $this->employmentRate = round(($employedCount / $this->totalRespondents) * 100, 1);

            // Average Salary (mock data for now)
            $this->averageSalary = '₱25,000';

            // Course Relevance
            $relevantJobsCount = $respondents->whereHas('employmentData', function($q) {
                $q->where('is_course_related', true);
            })->count();
            $this->courseRelevance = $employedCount > 0 ? round(($relevantJobsCount / $employedCount) * 100, 1) : 0;

            // Salary Distribution (mock data)
            $this->salaryDistribution = [
                'Below ₱15,000' => 15,
                '₱15,000 - ₱25,000' => 45,
                '₱25,000 - ₱35,000' => 28,
                '₱35,000 - ₱50,000' => 10,
                'Above ₱50,000' => 2,
            ];

            // Employment by Industry (mock data)
            $this->employmentByIndustry = collect([
                'Information Technology' => ['count' => 35, 'percentage' => 35],
                'Business Process Outsourcing' => ['count' => 25, 'percentage' => 25],
                'Finance & Banking' => ['count' => 15, 'percentage' => 15],
                'Education' => ['count' => 10, 'percentage' => 10],
                'Healthcare' => ['count' => 8, 'percentage' => 8],
                'Government' => ['count' => 7, 'percentage' => 7],
            ]);

            // Course Distribution
            $this->courseDistribution = $respondents->groupBy('course_graduated')
                ->map->count()
                ->sortDesc();
        }
    }

    public function generateReport()
    {
        $query = Respondent::with('employmentData');
        
        if ($this->selectedBatch) {
            $query->where('batch_id', $this->selectedBatch);
        }

        $respondents = $query->get();

        switch ($this->reportType) {
            case 'summary':
                $this->generateSummaryReport($respondents);
                break;
            case 'employment':
                $this->generateEmploymentReport($respondents);
                break;
            case 'salary':
                $this->generateSalaryReport($respondents);
                break;
            case 'course':
                $this->generateCourseReport($respondents);
                break;
        }
    }

    private function generateSummaryReport($respondents)
    {
        $this->reportData = [
            'title' => 'Summary Report',
            'subtitle' => 'Overall tracer study statistics and insights',
            'metrics' => [
                'Total Respondents' => $respondents->count(),
                'Employment Rate' => $this->employmentRate . '%',
                'Average Salary' => $this->averageSalary,
                'Course Relevance' => $this->courseRelevance . '%',
            ],
            'chart_data' => [
                'Employment Status' => [
                    'Employed' => $respondents->whereHas('employmentData', function($q) {
                        $q->where('is_presently_employed', true);
                    })->count(),
                    'Unemployed' => $respondents->whereHas('employmentData', function($q) {
                        $q->where('is_presently_employed', false);
                    })->count(),
                    'No Data' => $respondents->whereDoesntHave('employmentData')->count(),
                ],
            ],
        ];
    }

    private function generateEmploymentReport($respondents)
    {
        $industries = [];
        $positions = [];

        foreach ($respondents as $respondent) {
            if ($respondent->employmentData && $respondent->employmentData->company_name) {
                $industry = $respondent->employmentData->company_name;
                $position = $respondent->employmentData->present_occupation ?? 'Not specified';
                
                $industries[$industry] = ($industries[$industry] ?? 0) + 1;
                $positions[$position] = ($positions[$position] ?? 0) + 1;
            }
        }

        arsort($industries);
        arsort($positions);

        $this->reportData = [
            'title' => 'Employment Details Report',
            'subtitle' => 'Industry and position analysis of employed graduates',
            'table_data' => [
                'industries' => array_slice($industries, 0, 10, true),
                'positions' => array_slice($positions, 0, 10, true),
            ],
        ];
    }

    private function generateSalaryReport($respondents)
    {
        // Mock salary data
        $salaryRanges = [
            'Below ₱15,000' => 15,
            '₱15,000 - ₱25,000' => 45,
            '₱25,000 - ₱35,000' => 28,
            '₱35,000 - ₱50,000' => 10,
            'Above ₱50,000' => 2,
        ];

        $this->reportData = [
            'title' => 'Salary Analysis Report',
            'subtitle' => 'Distribution of graduate salaries across different ranges',
            'chart_data' => $salaryRanges,
        ];
    }

    private function generateCourseReport($respondents)
    {
        $courseStats = [];

        foreach ($respondents->groupBy('course_graduated') as $course => $courseRespondents) {
            $total = $courseRespondents->count();
            $employed = $courseRespondents->whereHas('employmentData', function($q) {
                $q->where('is_presently_employed', true);
            })->count();
            $relevant = $courseRespondents->whereHas('employmentData', function($q) {
                $q->where('is_course_related', true);
            })->count();

            $courseStats[$course] = [
                'total' => $total,
                'employed' => $employed,
                'relevant' => $relevant,
                'employment_rate' => $total > 0 ? round(($employed / $total) * 100, 1) : 0,
                'relevance_rate' => $employed > 0 ? round(($relevant / $employed) * 100, 1) : 0,
            ];
        }

        $this->reportData = [
            'title' => 'Course Analysis Report',
            'subtitle' => 'Performance metrics by course of study',
            'table_data' => $courseStats,
        ];
    }

    public function exportPDF()
    {
        session()->flash('message', 'PDF export functionality would be implemented here.');
        return redirect()->back();
    }

    public function exportExcel()
    {
        session()->flash('message', 'Excel export functionality would be implemented here.');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.unified-reports-dashboard');
    }
}
