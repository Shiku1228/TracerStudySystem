<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-5xl font-black text-gray-900 dark:text-gray-100 tracking-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Analytics Dashboard</h1>
        <p class="text-gray-700 dark:text-gray-400 mt-2 text-lg">Comprehensive analysis of graduate tracer study data</p>
    </div>

    <!-- Batch Filter -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <label for="batch-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Batch</label>
                <select 
                    id="batch-filter"
                    wire:model.live="selectedBatch" 
                    class="w-full sm:w-64 px-3 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                >
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batch_name }} ({{ $batch->created_at->format('M Y') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Showing data for: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $selectedBatch ? $batches->find($selectedBatch)->batch_name : 'All Batches' }}</span>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-400">Total Respondents</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($totalRespondents) }}</p>
                </div>
                <div class="p-3 rounded-lg bg-primary-100">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-400">Employment Rate</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $employmentRate }}%</p>
                </div>
                <div class="p-3 rounded-lg bg-secondary-100">
                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-400">Avg. Monthly Salary</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $averageSalary }}</p>
                </div>
                <div class="bg-primary-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-400">Course Relevance</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $courseRelevance }}%</p>
                </div>
                <div class="bg-secondary-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Salary Distribution -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Salary Distribution</h3>
            <div class="space-y-3">
                @foreach($salaryDistribution as $range => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $range }}</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-32 bg-gray-200 dark:bg-zinc-600 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-300" style="width: {{ $totalRespondents > 0 ? ($count / $totalRespondents) * 100 : 0 }}%; background-color: var(--primary-600)"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100 w-12 text-right">{{ $count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Industries -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Top Industries</h3>
            <div class="space-y-3">
                @foreach($employmentByIndustry->take(8) as $industry => $data)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400 truncate max-w-[180px]" title="{{ $industry }}">{{ $industry }}</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 dark:bg-zinc-600 rounded-full h-2">
                                <div class="h-2 rounded-full" style="width: {{ $data['percentage'] }}%; background-color: var(--secondary-600)"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100 w-12 text-right">{{ $data['count'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Course Distribution -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Courses by Respondent Count</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($courseDistribution as $course => $count)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-zinc-700 rounded-lg">
                    <span class="text-sm text-gray-700 dark:text-gray-300 truncate flex-1" title="{{ $course }}">{{ $course }}</span>
                    <span class="ml-2 px-2 py-1 rounded-full text-xs font-medium" style="background-color: var(--primary-100); color: var(--primary-800)">{{ $count }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Export Options -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Export Analytics</h3>
        <div class="flex flex-wrap gap-4">
            <button class="px-4 py-2 text-white rounded-lg transition" style="background-color: var(--primary-700)" onmouseover="this.style.backgroundColor='var(--primary-800)'" onmouseout="this.style.backgroundColor='var(--primary-700)'>
                Export as PDF
            </button>
            <button class="px-4 py-2 text-white rounded-lg transition" style="background-color: var(--secondary-700)" onmouseover="this.style.backgroundColor='var(--secondary-800)'" onmouseout="this.style.backgroundColor='var(--secondary-700)'>
                Export as Excel
            </button>
            <button class="px-4 py-2 text-white rounded-lg transition" style="background-color: var(--primary-700)" onmouseover="this.style.backgroundColor='var(--primary-800)'" onmouseout="this.style.backgroundColor='var(--primary-700)'>
                Generate Report
            </button>
        </div>
    </div>
</div>
