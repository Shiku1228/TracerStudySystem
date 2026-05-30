<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\TracerBatch;
use App\Models\Respondent;

class AnalyticsDashboard extends Component
{
    public $selectedBatch = null;
    public $batches;
    public $totalRespondents;
    public $employmentRate;
    public $courseRelevance;
    public $employmentByIndustry;
    public $courseDistribution;

    public function mount()
    {
        $this->batches = TracerBatch::orderBy('created_at', 'desc')->get();
        $this->loadAnalytics();
    }

    public function updatedSelectedBatch($batchId)
    {
        $this->loadAnalytics($batchId);
    }

    public function loadAnalytics($batchId = null)
    {
        $query = Respondent::with('employmentData');
        if ($batchId) {
            $query->where('batch_id', $batchId);
        }
        $respondents = $query->get();

        $this->totalRespondents = $respondents->count();
        $employedCount = $respondents->filter(fn($r) => $r->employmentData && $r->employmentData->is_presently_employed)->count();
        $this->employmentRate = $this->totalRespondents > 0 ? round(($employedCount / $this->totalRespondents) * 100, 1) : 0;

        $relevantJobs = $respondents->filter(fn($r) => $r->employmentData && $r->employmentData->is_course_related)->count();
        $this->courseRelevance = $employedCount > 0 ? round(($relevantJobs / $employedCount) * 100, 1) : 0;

        $this->employmentByIndustry = $respondents->map(fn($r) => $r->employmentData->company_name ?? 'Unknown')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(10)
            ->map(fn($c) => [
                'count' => $c,
                'percentage' => $this->totalRespondents > 0 ? round(($c / $this->totalRespondents) * 100, 1) : 0
            ]);

        $this->courseDistribution = $respondents->map(fn($r) => $r->course_graduated ?? 'Unknown')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(10);
    }

    public function render()
    {
        return view('livewire.analytics-dashboard');
    }
}
