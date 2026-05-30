<x-layouts::app :title="__('Dashboard Overview')">
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-2 rounded-full bg-green-500 pulse-live"></div>
                <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">System Active</span>
            </div>
            <h1 class="text-4xl font-bold text-zinc-900 dark:text-white tracking-tight">Tracer Study Dashboard</h1>
            <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-lg">Real-time graduate analytics and insights</p>
        </div>

        <!-- Quick Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-5 border border-zinc-200 dark:border-zinc-700 interactive-card group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-300 mb-1">Total Respondents</p>
                        <p class="text-3xl font-bold text-zinc-900 dark:text-white data-value animate-count">{{ number_format($total) }}</p>
                        <p class="text-xs text-zinc-500 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            +12% this month
                        </p>
                    </div>
                    <div class="bg-zinc-200/50 dark:bg-zinc-700/50 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl p-5 border interactive-card group bg-gradient-to-br from-copper-50 to-copper-100 border-copper-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium mb-1 text-copper-600">Employment Rate</p>
                        <p class="text-3xl font-bold data-value animate-count text-copper-900">{{ $employmentRate }}%</p>
                        <p class="text-xs mt-1 flex items-center gap-1 text-copper-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></svg>
                            +5.2% vs last year
                        </p>
                    </div>
                    <div class="p-3 rounded-xl bg-copper-200 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-copper-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl p-5 border interactive-card group bg-gradient-to-br from-deep-crimson-50 to-deep-crimson-100 border-deep-crimson-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium mb-1 text-deep-crimson-600">Course Relevance</p>
                        <p class="text-3xl font-bold data-value animate-count text-deep-crimson-900">{{ $alignmentRate }}%</p>
                        <p class="text-xs mt-1 flex items-center gap-1 text-deep-crimson-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            +3.4% alignment
                        </p>
                    </div>
                    <div class="p-3 rounded-xl bg-deep-crimson-200 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-deep-crimson-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 border border-zinc-200 dark:border-zinc-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Employment Distribution</h3>
                    <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                </div>
                <div class="relative h-64 w-full overflow-hidden">
                    <canvas wire:ignore id="employmentChart" class="block h-full w-full"></canvas>
                </div>
            </div>
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 border border-zinc-200 dark:border-zinc-700">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Respondent Distribution</h3>
        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
    </div>
    <div class="relative h-64 w-full overflow-hidden">
        <canvas wire:ignore id="respondentChart" class="block h-full w-full"></canvas>
    </div>
</div>
        </div>

        <!-- Main Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Dashboard Summary Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 interactive-card cursor-pointer border border-transparent hover:border-deep-crimson-200 transition-colors duration-200">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-deep-crimson-100 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-deep-crimson600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full text-deep-crimson-600 bg-deep-crimson-50">OVERVIEW</span>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">Dashboard</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4 flex-1">View key metrics and system overview at a glance</p>
                    <button class="w-full text-white px-4 py-2.5 rounded-xl font-medium transition-all duration-200 hover-scale bg-gradient-to-r from-deep-crimson-600 to-deep-crimson-500 focus:outline-none focus:ring-2 focus:ring-deep-crimson-500 focus:ring-offset-2" style="box-shadow: 0 10px 25px -5px rgba(150, 26, 31, 0.25);">
                        View Dashboard
                    </button>
                </div>
            </div>

            <!-- Upload Data Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-zinc-200 dark:border-zinc-700 interactive-card group cursor-pointer hover:border-copper-200 transition-colors duration-200">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-zinc-200/50 dark:bg-zinc-700/50 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full text-copper-600 bg-copper-50">DATA</span>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">Upload Data</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4 flex-1">Import Excel files from Google Forms to process tracer study data</p>
                    <a href="{{ route('upload') }}" class="w-full text-white px-4 py-2.5 rounded-xl font-medium transition-all duration-200 hover-scale text-center block bg-gradient-to-r from-copper-600 to-copper-500 focus:outline-none focus:ring-2 focus:ring-copper-500 focus:ring-offset-2" style="box-shadow: 0 10px 25px -5px rgba(185, 121, 64, 0.25);">
                        Upload Files
                    </a>
                </div>
            </div>

            <!-- Analytics Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-zinc-200 dark:border-zinc-700 interactive-card group cursor-pointer hover:border-burgundy-200 transition-colors duration-200">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-zinc-200/50 dark:bg-zinc-700/50 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-burgundy-600 dark:text-zinc-400 bg-burgundy-50 dark:bg-zinc-900/30 px-2 py-1 rounded-full">ANALYTICS</span>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">Analytics</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4 flex-1">Deep dive into employment statistics and graduate insights</p>
                    <a href="{{ route('analytics') }}" class="w-full text-white px-4 py-2.5 rounded-xl font-medium transition-all duration-200 hover-scale text-center block bg-gradient-to-r from-burgundy-600 to-burgundy-500 focus:outline-none focus:ring-2 focus:ring-burgundy-500 focus:ring-offset-2" style="box-shadow: 0 10px 25px -5px rgba(115, 24, 32, 0.25);">
                        View Analytics
                    </a>
                </div>
            </div>

            <!-- Reports Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 interactive-card cursor-pointer border border-transparent hover:border-deep-crimson-200 transition-colors duration-200">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-deep-crimson-100 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-deep-crimson-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full text-deep-crimson-600 bg-deep-crimson-50">REPORTS</span>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">Reports</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4 flex-1">Generate comprehensive tracer study reports and export data</p>
                    <a href="{{ route('reports') }}" class="w-full text-white px-4 py-2.5 rounded-xl font-medium transition-all duration-200 hover-scale text-center block bg-gradient-to-r from-deep-crimson-600 to-deep-crimson-500 focus:outline-none focus:ring-2 focus:ring-deep-crimson-500 focus:ring-offset-2" style="box-shadow: 0 10px 25px -5px rgba(150, 26, 31, 0.25);">
                        Generate Reports
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity Summary -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 interactive-card">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-zinc-100 dark:bg-zinc-700 rounded-lg">
                        <svg class="w-5 h-5 text-zinc-600 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Recent Activity</h3>
                        <p class="text-xs text-zinc-500">Live updates from the system</p>
                    </div>
                </div>
                <span class="text-xs font-medium text-zinc-500 bg-zinc-100 dark:bg-zinc-700 px-3 py-1 rounded-full">Last 24 hours</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-4 p-4 rounded-xl border bg-gradient-to-r from-primary-50 to-transparent border-primary-100 hover:border-primary-300 transition-colors duration-200 cursor-pointer">
                    <div class="text-white p-2.5 rounded-xl shadow-lg" style="background-color: var(--primary); box-shadow: 0 10px 25px -5px rgba(150, 26, 31, 0.3);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">New Upload</p>
                        <p class="text-xs text-zinc-500">2026 Q1 Graduate Tracer</p>
                        <p class="text-xs mt-1 text-primary-500">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 p-4 rounded-xl border bg-gradient-to-r from-secondary-50 to-transparent border-secondary-100 hover:border-secondary-300 transition-colors duration-200 cursor-pointer">
                    <div class="text-white p-2.5 rounded-xl shadow-lg" style="background-color: var(--secondary); box-shadow: 0 10px 25px -5px rgba(185, 121, 64, 0.3);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">Report Generated</p>
                        <p class="text-xs text-zinc-500">Employment Analysis PDF</p>
                        <p class="text-xs mt-1 text-secondary-500">5 hours ago</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 p-4 rounded-xl border bg-gradient-to-r from-primary-50 to-transparent border-primary-100 hover:border-primary-300 transition-colors duration-200 cursor-pointer">
                    <div class="text-white p-2.5 rounded-xl shadow-lg" style="background-color: var(--primary); box-shadow: 0 10px 25px -5px rgba(139, 0, 0, 0.3);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">Analytics Viewed</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.__dashboardChartFactory = () => {
            if (!window.Chart) {
                return;
            }

            window.__dashboardChartInstances = window.__dashboardChartInstances || {};
            const chartInstances = window.__dashboardChartInstances;

            const destroyChart = (key) => {
                if (chartInstances[key]) {
                    chartInstances[key].destroy();
                    chartInstances[key] = null;
                }
            };

                const isDark = document.documentElement.classList.contains('dark');
                const isRmmc = document.documentElement.classList.contains('theme-rmmc');
                const textColor = isRmmc ? '#030215' : (isDark ? '#c0c0c0' : '#731820');
                const gridColor = isRmmc ? 'rgba(3, 2, 21, 0.12)' : (isDark ? 'rgba(192, 192, 192, 0.12)' : 'rgba(115, 24, 32, 0.12)');
                const donutColors = isRmmc ? ['#030215', '#04054f', '#0f0f53', '#0c0c7b'] : ['#961a1f', '#b97940', '#c0c0c0', '#040405'];
                const barColor = isRmmc ? '#04054f' : '#3b82f6';

            const employmentCanvas = document.getElementById('employmentChart');
            if (employmentCanvas) {
                destroyChart('employment');
                chartInstances.employment = new Chart(employmentCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($employmentStats->pluck('employment_status')) !!},
                        datasets: [{
                            data: {!! json_encode($employmentStats->pluck('count')) !!},
                            backgroundColor: donutColors,
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: textColor, font: { family: 'Inter' } }
                            }
                        },
                        cutout: '70%'
                    }
                });
            }

            const respondentCanvas = document.getElementById('respondentChart');
            if (respondentCanvas) {
                destroyChart('respondent');
                chartInstances.respondent = new Chart(respondentCanvas, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($employmentStats->pluck('employment_status')) !!},
                        datasets: [{
                            label: 'Count',
                            data: {!! json_encode($employmentStats->pluck('count')) !!},
                            backgroundColor: barColor,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { color: textColor, font: { family: 'Inter' } },
                                grid: { color: gridColor }
                            },
                            x: {
                                ticks: { color: textColor, font: { family: 'Inter' } },
                                grid: { color: gridColor }
                            }
                        }
                    }
                });
            }
        };

        if (!window.__dashboardChartsBound) {
            window.__dashboardChartsBound = true;
            document.addEventListener('DOMContentLoaded', () => window.__dashboardChartFactory());
            document.addEventListener('livewire:navigated', () => window.__dashboardChartFactory());
            document.addEventListener('livewire:initialized', () => window.__dashboardChartFactory());
            window.addEventListener('pageshow', () => window.__dashboardChartFactory());
        }

        window.__dashboardChartFactory();
    </script>
</x-layouts::app>
