<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-5xl font-black text-gray-900 dark:text-gray-100 tracking-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Reports & Analytics</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">Comprehensive tracer study reports and analytics dashboard</p>
    </div>

    <!-- Reports Section (Top) -->
    <div class="mb-8">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Generate Reports</h2>
            
            <!-- Controls -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="batch-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Batch</label>
                    <select 
                        id="batch-filter"
                        wire:model.live="selectedBatch" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400"
                    >
                        <option value="">All Batches</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->batch_name }} ({{ $batch->created_at->format('M Y') }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="report-type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Type</label>
                    <select 
                        id="report-type"
                        wire:model.live="reportType" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400"
                    >
                        <option value="summary">Summary Report</option>
                        <option value="employment">Employment Details</option>
                        <option value="salary">Salary Analysis</option>
                        <option value="course">Course Analysis</option>
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <button wire:click="exportPDF" wire:loading.attr="disabled" class="flex-1 px-4 py-2 text-white rounded-lg transition-colors duration-200 cursor-pointer hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed" style="background-color: var(--primary-700)">
                        <span wire:loading.remove>Export PDF</span>
                        <span wire:loading>Exporting...</span>
                    </button>
                    <button wire:click="exportExcel" wire:loading.attr="disabled" class="flex-1 px-4 py-2 text-white rounded-lg transition-colors duration-200 cursor-pointer hover:bg-secondary-800 focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed" style="background-color: var(--secondary-700)">
                        <span wire:loading.remove>Export Excel</span>
                        <span wire:loading>Exporting...</span>
                    </button>
                </div>
            </div>

            <!-- Report Display -->
            <div class="border-t pt-6">
                <!-- Report Header -->
                <div class="border-b pb-4 mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $reportData['title'] ?? 'Report' }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $reportData['subtitle'] ?? '' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Generated on: {{ now()->format('F d, Y h:i A') }}</p>
                </div>

                <!-- Flash Message -->
                @if(session()->has('message'))
                    <div class="mb-6 p-4 rounded-lg bg-primary-100 border border-primary-400 text-primary-700">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Metrics Grid -->
                @if(isset($reportData['metrics']))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        @foreach($reportData['metrics'] as $label => $value)
                            <div class="bg-gray-50 dark:bg-zinc-700 rounded-lg p-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $label }}</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Chart Data -->
                @if(isset($reportData['chart_data']))
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Visual Analysis</h4>
                        
                        @if($reportType === 'summary')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-3">Employment Status</h5>
                                    @foreach($reportData['chart_data']['Employment Status'] as $status => $count)
                                        <div class="mb-2">
                                            <div class="flex justify-between text-sm mb-1">
                                                <span>{{ $status }}</span>
                                                <span class="font-medium">{{ $count }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-zinc-600 rounded-full h-2">
                                                @php
                                                    $total = collect($reportData['chart_data']['Employment Status'])->sum();
                                                    $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                                @endphp
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($reportType === 'salary')
                            <div class="space-y-3">
                                @foreach($reportData['chart_data'] as $range => $count)
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span>{{ $range }}</span>
                                            <span class="font-medium">{{ $count }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            @php
                                                $total = collect($reportData['chart_data'])->sum();
                                                $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                            @endphp
                                            <div class="h-2 rounded-full" style="width: {{ $percentage }}%; background-color: var(--secondary-600)"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Table Data -->
                @if(isset($reportData['table_data']))
                    <div class="mb-8">
                        @if($reportType === 'employment')
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">🏢 Top Industries</h4>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm">
                                            <thead class="bg-gray-50 dark:bg-zinc-700">
                                                <tr>
                                                    <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300">Industry</th>
                                                    <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reportData['table_data']['industries'] as $industry => $count)
                                                    <tr class="border-b border-gray-200 dark:border-zinc-600">
                                                        <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $industry }}</td>
                                                        <td class="text-right py-2 px-3 font-medium text-gray-900 dark:text-gray-100">{{ $count }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">💼 Top Positions</h4>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm">
                                            <thead class="bg-gray-50 dark:bg-zinc-700">
                                                <tr>
                                                    <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300">Position</th>
                                                    <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reportData['table_data']['positions'] as $position => $count)
                                                    <tr class="border-b border-gray-200 dark:border-zinc-600">
                                                        <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $position }}</td>
                                                        <td class="text-right py-2 px-3 font-medium text-gray-900 dark:text-gray-100">{{ $count }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @elseif($reportType === 'course')
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">🎓 Course Performance Analysis</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-50 dark:bg-zinc-700">
                                        <tr>
                                            <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300">Course</th>
                                            <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Total</th>
                                            <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Employed</th>
                                            <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Relevant Jobs</th>
                                            <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Employment Rate</th>
                                            <th class="text-right py-2 px-3 text-gray-700 dark:text-gray-300">Relevance Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData['table_data'] as $course => $data)
                                            <tr class="border-b border-gray-200 dark:border-zinc-600">
                                                <td class="py-2 px-3 font-medium text-gray-900 dark:text-gray-100">{{ $course }}</td>
                                                <td class="text-right py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data['total'] }}</td>
                                                <td class="text-right py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data['employed'] }}</td>
                                                <td class="text-right py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data['relevant'] }}</td>
                                                <td class="text-right py-2 px-3">
                                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 rounded-full text-xs">
                                                        {{ $data['employment_rate'] }}%
                                                    </span>
                                                </td>
                                                <td class="text-right py-2 px-3">
                                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">
                                                        {{ $data['relevance_rate'] }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Report Footer -->
                <div class="border-t pt-4 mt-8">
                    <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300">Tracer Study Reporting System</p>
                            <p class="text-gray-600 dark:text-gray-400">Confidential • For Internal Use Only</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-700 dark:text-gray-300">Page 1 of 1</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ now()->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section (Bottom) -->
    <div>
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">📈 Analytics Dashboard</h2>
            
            <!-- Batch Filter for Analytics -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <label for="analytics-batch-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Analytics by Batch</label>
                    <select 
                        id="analytics-batch-filter"
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

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="rounded-xl border p-4" style="background: linear-gradient(to bottom right, var(--primary-50), var(--primary-100)); border-color: var(--primary-200)">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--primary-600)">Total Respondents</p>
                            <p class="text-2xl font-bold" style="color: var(--primary-900)">{{ number_format($totalRespondents) }}</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background-color: var(--primary-100)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--primary-600)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border p-4" style="background: linear-gradient(to bottom right, var(--secondary-50), var(--secondary-100)); border-color: var(--secondary-200)">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--secondary-600)">Employment Rate</p>
                            <p class="text-2xl font-bold" style="color: var(--secondary-900)">{{ $employmentRate }}%</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background-color: var(--secondary-100)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--secondary-600)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4A2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border p-4" style="background: linear-gradient(to bottom right, var(--accent-50), var(--accent-100)); border-color: var(--accent-200)">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--accent-600)">Avg. Monthly Salary</p>
                            <p class="text-2xl font-bold" style="color: var(--accent-900)">{{ $averageSalary }}</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background-color: var(--accent-100)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--accent-600)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-neutral-50 to-neutral-100 dark:from-neutral-900/20 dark:to-neutral-800/20 rounded-xl border border-neutral-200 dark:border-neutral-800 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Course Relevance</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $courseRelevance }}%</p>
                        </div>
                        <div class="bg-neutral-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Salary Distribution -->
                <div class="bg-gray-50 dark:bg-zinc-700 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">💰 Salary Distribution</h3>
                    <div class="space-y-3">
                        @foreach($salaryDistribution as $range => $count)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $range }}</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-32 bg-gray-200 dark:bg-zinc-600 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $totalRespondents > 0 ? ($count / $totalRespondents) * 100 : 0 }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100 w-12 text-right">{{ $count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Industries -->
                <div class="bg-gray-50 dark:bg-zinc-700 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">🏢 Top Industries</h3>
                    <div class="space-y-3">
                        @foreach($employmentByIndustry->take(8) as $industry => $data)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400 truncate max-w-[180px]" title="{{ $industry }}">{{ $industry }}</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-24 bg-gray-200 dark:bg-zinc-600 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $data['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100 w-12 text-right">{{ $data['count'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Course Distribution -->
            <div class="bg-gray-50 dark:bg-zinc-700 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">🎓 Courses by Respondent Count</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($courseDistribution as $course => $count)
                        <div class="flex items-center justify-between p-3 bg-white dark:bg-zinc-800 rounded-lg">
                            <span class="text-sm text-gray-700 dark:text-gray-300 truncate flex-1" title="{{ $course }}">{{ $course }}</span>
                            <span class="ml-2 px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs font-medium">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
