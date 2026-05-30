<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Respondent;

class RespondentDirectory extends Component
{
    public $statistics = [];
    public $graduatesByYear = [];

    public function mount()
    {
        // Core statistics
        $total = Respondent::count();
        $employed = Respondent::whereHas('employmentData', function ($q) {
            $q->where('is_presently_employed', true);
        })->count();
        $unemployed = Respondent::whereHas('employmentData', function ($q) {
            $q->where('is_presently_employed', false);
        })->count();
        $employmentRate = $total ? round($employed * 100 / $total, 2) : 0;

        $this->statistics = [
            'total' => $total,
            'employed' => $employed,
            'unemployed' => $unemployed,
            'employment_rate' => $employmentRate,
        ];

        // Graduates per year
        $years = Respondent::select('graduation_year')
            ->groupBy('graduation_year')
            ->orderBy('graduation_year')
            ->pluck('graduation_year');
        $this->graduatesByYear = $years->mapWithKeys(function ($year) {
            return [$year => Respondent::where('graduation_year', $year)->count()];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.respondent-directory', [
            'statistics' => $this->statistics,
            'graduatesByYear' => $this->graduatesByYear,
        ]);
    }
}
?>
