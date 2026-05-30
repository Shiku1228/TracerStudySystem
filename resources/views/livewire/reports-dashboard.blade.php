<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-5xl font-black text-[#040405] dark:text-[#c0c0c0] tracking-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Reports Dashboard</h1>
        <p class="text-[#731820] dark:text-[#c0c0c0] mt-2 text-lg">Generate comprehensive tracer study reports</p>
    </div>

    <!-- Controls -->
    <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="batch-filter" class="block text-sm font-medium text-[#731820] dark:text-[#c0c0c0] mb-2">Select Batch</label>
                <select 
                    id="batch-filter"
                    wire:model.live="selectedBatch" 
                    class="w-full px-3 py-2 border border-[#731820]/20 bg-[#b97940]/15 dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:ring-2 focus:ring-[#731820] focus:border-[#731820]"
                >
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batch_name }} ({{ $batch->created_at->format('M Y') }})</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="report-type" class="block text-sm font-medium text-[#731820] dark:text-[#c0c0c0] mb-2">Report Type</label>
                <select 
                    id="report-type"
                    wire:model.live="reportType" 
                    class="w-full px-3 py-2 border border-[#731820]/20 bg-[#b97940]/15 dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:ring-2 focus:ring-[#731820] focus:border-[#731820]"
                >
                    <option value="summary">Summary Report</option>
                    <option value="employment">Employment Details</option>

                    <option value="course">Course Analysis</option>
                </select>
            </div>

            <div class="flex items-end space-x-2">
                <button wire:click="exportPDF" wire:loading.attr="disabled" class="flex-1 px-4 py-2 text-white rounded-lg transition-colors duration-200 cursor-pointer hover:bg-[#731820] focus:outline-none focus:ring-2 focus:ring-[#731820] focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed" style="background-color: var(--burgundy)">
                    <span wire:loading.remove>Export PDF</span>
                    <span wire:loading>Exporting...</span>
                </button>
                <button wire:click="exportExcel" wire:loading.attr="disabled" class="flex-1 px-4 py-2 text-white rounded-lg transition-colors duration-200 cursor-pointer hover:bg-[#b97940] focus:outline-none focus:ring-2 focus:ring-[#b97940] focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed" style="background-color: var(--copper)">
                    <span wire:loading.remove>Export Excel</span>
                    <span wire:loading>Exporting...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Report Display -->
    <div class="card-surface dark:card-surface-dark rounded-xl p-6">
        <!-- Report Header -->
        <div class="border-b border-[#731820]/20 pb-4 mb-6">
            <h2 class="text-2xl font-bold text-[#040405] dark:text-[#c0c0c0]">{{ $reportData['title'] ?? 'Report' }}</h2>
            <p class="text-[#731820] dark:text-[#c0c0c0] mt-1">{{ $reportData['subtitle'] ?? '' }}</p>
            <p class="text-sm text-[#731820]/80 dark:text-[#c0c0c0] mt-2">Generated on: {{ now()->format('F d, Y h:i A') }}</p>
        </div>

        <!-- Flash Message -->
        @if(session()->has('message'))
            <div class="mb-6 p-4 bg-[#961a1f]/10 dark:bg-[#040405] border border-[#961a1f] text-[#961a1f] dark:text-[#c0c0c0] rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Metrics Grid -->
        @if(isset($reportData['metrics']))
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @foreach($reportData['metrics'] as $label => $value)
                    <div class="bg-white dark:bg-[#040405] rounded-lg p-4 border border-[#b97940]/20">
                        <p class="text-sm text-[#731820] dark:text-[#c0c0c0]">{{ $label }}</p>
                        <p class="text-xl font-bold text-[#040405] dark:text-[#c0c0c0]">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Chart Data -->
        @if(isset($reportData['chart_data']))
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Visual Analysis</h3>
                
                @if($reportType === 'summary')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-medium text-[#731820] dark:text-[#c0c0c0] mb-3">Employment Status</h4>
                            @foreach($reportData['chart_data']['Employment Status'] as $status => $count)
                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>{{ $status }}</span>
                                        <span class="font-medium">{{ $count }}</span>
                                    </div>
                                    <div class="w-full bg-[#c0c0c0] dark:bg-[#040405] rounded-full h-2">
                                        @php
                                            $total = collect($reportData['chart_data']['Employment Status'])->sum();
                                            $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                        @endphp
                                        <div class="h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%; background-color: var(--burgundy)"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
@if($reportType === 'employment')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        @foreach($reportData['metrics'] as $label => $value)
            <div class="p-4 bg-white dark:bg-[#040405] rounded-lg shadow border border-[#731820]/15">
                <div class="text-sm font-medium text-[#731820] dark:text-[#c0c0c0]">{{ $label }}</div>
                <div class="mt-1 text-xl font-semibold text-[#040405] dark:text-[#c0c0c0]">{{ $value }}</div>
            </div>
        @endforeach
    </div>
@endif

        <!-- Table Data -->
        @if(isset($reportData['table_data']))
            <div class="mb-8">
                @if($reportType === 'employment')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Top Industries</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                        <thead class="bg-[#b97940]/10 dark:bg-[#040405]">
                                        <tr>
                                            <th class="text-left py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Industry</th>
                                            <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData['table_data']['industries'] as $industry => $count)
                                            <tr class="border-b border-[#731820]/20">
                                                <td class="py-2 px-3 text-[#040405] dark:text-[#c0c0c0]">{{ $industry }}</td>
                                                <td class="text-right py-2 px-3 font-medium text-[#040405] dark:text-[#c0c0c0]">{{ $count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Top Positions</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                        <thead class="bg-[#b97940]/10 dark:bg-[#040405]">
                                        <tr>
                                            <th class="text-left py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Position</th>
                                            <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData['table_data']['positions'] as $position => $count)
                                            <tr class="border-b border-[#731820]/20">
                                                <td class="py-2 px-3 text-[#040405] dark:text-[#c0c0c0]">{{ $position }}</td>
                                                <td class="text-right py-2 px-3 font-medium text-[#040405] dark:text-[#c0c0c0]">{{ $count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif($reportType === 'course')
                    <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Course Performance Analysis</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-[#b97940]/10 dark:bg-[#040405]">
                                <tr>
                                    <th class="text-left py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Course</th>
                                    <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Total</th>
                                    <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Employed</th>
                                    <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Relevant Jobs</th>
                                    <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Employment Rate</th>
                                    <th class="text-right py-2 px-3 text-[#731820] dark:text-[#c0c0c0]">Relevance Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportData['table_data'] as $course => $data)
                                    <tr class="border-b border-[#731820]/20">
                                        <td class="py-2 px-3 font-medium text-[#040405] dark:text-[#c0c0c0]">{{ $course }}</td>
                                        <td class="text-right py-2 px-3 text-[#040405] dark:text-[#c0c0c0]">{{ $data['total'] }}</td>
                                        <td class="text-right py-2 px-3 text-[#040405] dark:text-[#c0c0c0]">{{ $data['employed'] }}</td>
                                        <td class="text-right py-2 px-3 text-[#040405] dark:text-[#c0c0c0]">{{ $data['relevant'] }}</td>
                                        <td class="text-right py-2 px-3">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium" style="background-color: var(--copper-100); color: var(--copper-800)">
                                                {{ $data['employment_rate'] }}%
                                            </span>
                                        </td>
                                        <td class="text-right py-2 px-3">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium" style="background-color: var(--deep-crimson-100); color: var(--deep-crimson-800)">
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
            <div class="flex justify-between items-center text-sm text-[#731820] dark:text-[#c0c0c0]">
                <div>
                    <p class="text-[#040405] dark:text-[#c0c0c0]">Tracer Study Reporting System</p>
                    <p class="text-[#731820] dark:text-[#c0c0c0]">Confidential • For Internal Use Only</p>
                </div>
                <div class="text-right">
                    <p class="text-[#040405] dark:text-[#c0c0c0]">Page 1 of 1</p>
                    <p class="text-[#731820] dark:text-[#c0c0c0]">{{ now()->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
