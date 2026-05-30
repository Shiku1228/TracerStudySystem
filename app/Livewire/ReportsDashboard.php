<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TracerBatch;
use App\Models\Respondent;
use App\Models\EmploymentData;

class ReportsDashboard extends Component
{
    public $selectedBatch = null;
    public $batches;
    public $reportType = 'summary';
    public $reportData = [];

    public function mount()
    {
        $this->batches = TracerBatch::orderBy('created_at', 'desc')->get();
        $this->generateReport();
    }

    public function updatedSelectedBatch()
    {
        $this->generateReport();
    }

    public function updatedReportType()
    {
        $this->generateReport();
    }

    public function generateReport()
    {
        $query = Respondent::with('employmentData', 'batch');
        
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
            // Salary case removed
            case 'course':
                $this->generateCourseReport($respondents);
                break;
        }
    }

    private function generateSummaryReport($respondents)
    {
        $total = $respondents->count();
        $employed = $respondents->filter(function($r) {
            return $r->employmentData && $r->employmentData->is_presently_employed;
        })->count();

        $this->reportData = [
            'title' => 'Tracer Study Summary Report',
            'subtitle' => $this->selectedBatch ? $this->batches->find($this->selectedBatch)->batch_name : 'All Batches',
            'metrics' => [
                'Total Respondents' => $total,
                'Employed Graduates' => $employed,
                'Employment Rate' => $total > 0 ? round(($employed / $total) * 100, 1) . '%' : '0%',
                'Unemployed Graduates' => $total - $employed,
            ],
            'chart_data' => [
                'Employment Status' => [
                    'Employed' => $employed,
                    'Unemployed' => $total - $employed,
                ]
            ]
        ];
    }

    private function generateEmploymentReport($respondents)
    {
        $employedRespondents = $respondents->filter(function($r) {
            return $r->employmentData && $r->employmentData->is_presently_employed;
        });

        $industries = $employedRespondents
            ->map(function($r) { return $r->employmentData->company_name ?? 'Unknown'; })
            ->filter()
            ->countBy()
            ->sortDesc();

        $positions = $employedRespondents
            ->map(function($r) { return $r->employmentData->position_designation ?? 'Unknown'; })
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(10);

        $this->reportData = [
            'title' => 'Employment Details Report',
            'subtitle' => $this->selectedBatch ? $this->batches->find($this->selectedBatch)->batch_name : 'All Batches',
            'metrics' => [
                'Total Respondents' => $respondents->count(),
                'Unique Industries' => $industries->count(),
                'Top Industry' => $industries->keys()->first() ?: 'N/A',
                'Most Common Position' => $positions->keys()->first() ?: 'N/A',
            ],
            'table_data' => [
                'industries' => $industries->take(10),
                'positions' => $positions,
            ]
        ];
    }

    private function generateSalaryReport($respondents)
    {
        $employedRespondents = $respondents->filter(function($r) {
            return $r->employmentData && $r->employmentData->is_presently_employed;
        });

        // Note: monthly_income field doesn't exist in EmploymentData model yet
        // This is a placeholder until salary field is properly defined
        $salaries = collect(); // Empty collection for now

        $salaryRanges = [
            'Below ₱10,000' => $salaries->filter(fn($s) => $s < 10000)->count(),
            '₱10,000 - ₱15,000' => $salaries->filter(fn($s) => $s >= 10000 && $s < 15000)->count(),
            '₱15,000 - ₱20,000' => $salaries->filter(fn($s) => $s >= 15000 && $s < 20000)->count(),
            '₱20,000 - ₱30,000' => $salaries->filter(fn($s) => $s >= 20000 && $s < 30000)->count(),
            'Above ₱30,000' => $salaries->filter(fn($s) => $s >= 30000)->count(),
        ];

        $this->reportData = [
            'title' => 'Salary Analysis Report',
            'subtitle' => $this->selectedBatch ? $this->batches->find($this->selectedBatch)->batch_name : 'All Batches',
            'metrics' => [
                'Average Salary' => $salaries->isNotEmpty() ? '₱' . number_format($salaries->avg(), 2) : 'No data',
                'Highest Salary' => $salaries->isNotEmpty() ? '₱' . number_format($salaries->max(), 2) : 'No data',
                'Lowest Salary' => $salaries->isNotEmpty() ? '₱' . number_format($salaries->min(), 2) : 'No data',
                'Median Salary' => $salaries->isNotEmpty() ? '₱' . number_format($salaries->median(), 2) : 'No data',
            ],
            'chart_data' => $salaryRanges
        ];
    }

    private function generateCourseReport($respondents)
    {
        $courses = $respondents
            ->map(function($r) { return $r->course_graduated ?? 'Unknown'; })
            ->filter()
            ->countBy()
            ->sortDesc();

        $employedByCourse = $respondents
            ->filter(function($r) {
                return $r->employmentData && $r->employmentData->is_presently_employed;
            })
            ->map(function($r) { return $r->course_graduated ?? 'Unknown'; })
            ->filter()
            ->countBy();

        $courseRelevance = [];
        foreach ($courses as $course => $total) {
            $employed = $employedByCourse->get($course, 0);
            $relevant = $respondents
                ->filter(function($r) use ($course) {
                    return $r->course_graduated === $course &&
                           $r->employmentData &&
                           $r->employmentData->is_course_related;
                })
                ->count();

            $courseRelevance[$course] = [
                'total' => $total,
                'employed' => $employed,
                'relevant' => $relevant,
                'employment_rate' => $total > 0 ? round(($employed / $total) * 100, 1) : 0,
                'relevance_rate' => $employed > 0 ? round(($relevant / $employed) * 100, 1) : 0,
            ];
        }

        $this->reportData = [
            'title' => 'Course Analysis Report',
            'subtitle' => $this->selectedBatch ? $this->batches->find($this->selectedBatch)->batch_name : 'All Batches',
            'metrics' => [
                'Total Courses' => $courses->count(),
                'Most Popular Course' => $courses->keys()->first() ?: 'N/A',
                'Highest Employment Rate' => collect($courseRelevance)->max('employment_rate') . '%',
                'Highest Relevance Rate' => collect($courseRelevance)->max('relevance_rate') . '%',
            ],
            'table_data' => $courseRelevance
        ];
    }

    public function exportPDF()
    {
        // This would generate and download a PDF report
        // Implementation would depend on your PDF library choice
        session()->flash('message', 'PDF export functionality would be implemented here');
    }

    public function exportExcel()
    {
        // This would generate and download an Excel report
        // Implementation would use Laravel Excel package
        session()->flash('message', 'Excel export functionality would be implemented here');
    }

    public function render()
    {
        return view('livewire.reports-dashboard');
    }
}
