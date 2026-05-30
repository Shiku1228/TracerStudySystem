<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Respondent;
use App\Models\TracerBatch;

class RespondentDirectory extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCourse = '';
    public $selectedYear = '';
    public $selectedEmploymentStatus = '';
    public $selectedWorkLocation = '';
    public $selectedGender = '';
    public $selectedCivilStatus = '';
    public $selectedBatch = '';
    public $sortBy = 'graduation_year';
    public $sortOrder = 'desc';

    public $courses = [];
    public $years = [];
    public $genders = [];
    public $civilStatuses = [];
    public $batches = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCourse' => ['except' => ''],
        'selectedYear' => ['except' => ''],
        'selectedEmploymentStatus' => ['except' => ''],
        'selectedWorkLocation' => ['except' => ''],
        'selectedGender' => ['except' => ''],
        'selectedCivilStatus' => ['except' => ''],
        'selectedBatch' => ['except' => ''],
        'sortBy' => ['except' => 'graduation_year'],
        'sortOrder' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->loadFilters();
    }

    public function loadFilters()
    {
        $this->courses = Respondent::distinct('course_graduated')
            ->pluck('course_graduated')
            ->filter()
            ->sort()
            ->values();

        $this->years = Respondent::distinct('graduation_year')
            ->orderBy('graduation_year', 'desc')
            ->pluck('graduation_year')
            ->filter()
            ->values();

        $this->genders = Respondent::distinct('gender')
            ->pluck('gender')
            ->filter()
            ->sort()
            ->values();

        $this->civilStatuses = Respondent::distinct('civil_status')
            ->pluck('civil_status')
            ->filter()
            ->sort()
            ->values();

        $this->batches = TracerBatch::orderBy('created_at', 'desc')
            ->get(['id', 'batch_name']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCourse()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }

    public function updatedSelectedEmploymentStatus()
    {
        $this->resetPage();
    }

    public function updatedSelectedWorkLocation()
    {
        $this->resetPage();
    }

    public function updatedSelectedGender()
    {
        $this->resetPage();
    }

    public function updatedSelectedCivilStatus()
    {
        $this->resetPage();
    }

    public function updatedSelectedBatch()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedSortOrder()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'selectedCourse',
            'selectedYear',
            'selectedEmploymentStatus',
            'selectedWorkLocation',
            'selectedGender',
            'selectedCivilStatus',
            'selectedBatch',
            'sortBy',
            'sortOrder'
        ]);
        $this->sortBy = 'graduation_year';
        $this->sortOrder = 'desc';
    }

    public function getRespondentsProperty()
    {
        $query = Respondent::with(['employmentData', 'batch']);

        // Search by name
        if ($this->search) {
            $query->where('full_name', 'LIKE', "%{$this->search}%");
        }

        // Filter by course
        if ($this->selectedCourse) {
            $query->where('course_graduated', $this->selectedCourse);
        }

        // Filter by graduation year
        if ($this->selectedYear) {
            $query->where('graduation_year', $this->selectedYear);
        }

        // Filter by employment status
        if ($this->selectedEmploymentStatus) {
            $query->whereHas('employmentData', function($q) {
                if ($this->selectedEmploymentStatus === 'employed') {
                    $q->where('is_presently_employed', true);
                } elseif ($this->selectedEmploymentStatus === 'unemployed') {
                    $q->where('is_presently_employed', false);
                }
            });
        }

        // Filter by work location
        if ($this->selectedWorkLocation) {
            $query->whereHas('employmentData', function($q) {
                $q->where('place_of_work', $this->selectedWorkLocation);
            });
        }

        // Filter by gender
        if ($this->selectedGender) {
            $query->where('gender', $this->selectedGender);
        }

        // Filter by civil status
        if ($this->selectedCivilStatus) {
            $query->where('civil_status', $this->selectedCivilStatus);
        }

        // Filter by batch
        if ($this->selectedBatch) {
            $query->where('batch_id', $this->selectedBatch);
        }

        // Sorting
        if (in_array($this->sortBy, ['full_name', 'graduation_year', 'created_at'])) {
            $query->orderBy($this->sortBy, $this->sortOrder);
        }

        return $query->paginate(10);
    }

    public function getStatisticsProperty()
    {
        $totalRespondents = Respondent::count();
        $employedCount = Respondent::whereHas('employmentData', function($q) {
            $q->where('is_presently_employed', true);
        })->count();
        
        $employmentRate = $totalRespondents > 0 ? round(($employedCount / $totalRespondents) * 100, 1) : 0;

        return [
            'total' => $totalRespondents,
            'employed' => $employedCount,
            'unemployed' => $totalRespondents - $employedCount,
            'employment_rate' => $employmentRate,
        ];
    }

    public function render()
    {
        return view('livewire.respondent-directory', [
            'respondents' => $this->respondents,
            'statistics' => $this->statistics,
        ]);
    }
}
