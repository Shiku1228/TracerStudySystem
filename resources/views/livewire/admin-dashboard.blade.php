<div>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-5xl font-black text-[#040405] dark:text-[#c0c0c0] tracking-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.08);">Admin Dashboard</h1>
            <p class="text-[#731820] dark:text-[#c0c0c0] mt-2 text-lg">System administration and management overview</p>
        </div>

        <!-- Quick System Stats -->
        <div class="flex flex-col lg:flex-row gap-4 mb-8">
            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#731820] dark:text-[#c0c0c0]">Total Users</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-[#731820] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#961a1f] dark:text-[#c0c0c0]">Data Uploads</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ $totalUploads }}</p>
                    </div>
                    <div class="bg-[#961a1f] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#b97940] dark:text-[#c0c0c0]">Records Processed</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ number_format($totalReports) }}</p>
                    </div>
                    <div class="bg-[#b97940] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-[#040405]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Employment Statistics -->
        <div class="flex flex-col lg:flex-row gap-4 mb-8">
            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#961a1f] dark:text-[#c0c0c0]">Employed</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ number_format($employmentStats['employed']) }}</p>
                        <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $employmentStats['employed_percentage'] }}% of total</p>
                    </div>
                    <div class="bg-[#961a1f] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#731820] dark:text-[#c0c0c0]">Non-Employed</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ number_format($employmentStats['non_employed']) }}</p>
                        <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $employmentStats['non_employed_percentage'] }}% of total</p>
                    </div>
                    <div class="bg-[#731820] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#b97940] dark:text-[#c0c0c0]">Course-Related Jobs</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ number_format($employmentStats['employed_with_course_related']) }}</p>
                        <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $employmentStats['course_related_percentage'] }}% of employed</p>
                    </div>
                    <div class="bg-[#b97940] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-[#040405]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#040405] dark:text-[#c0c0c0]">Total Respondents</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ number_format($employmentStats['total_respondents']) }}</p>
                        <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">All records</p>
                    </div>
                    <div class="bg-[#040405] p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="card-surface dark:card-surface-dark rounded-xl p-6">
            <h3 class="text-lg font-semibold text-[#040405] dark:text-white mb-4">Graduation Per Year</h3>
            <div class="relative h-48 w-full overflow-hidden">
                <canvas wire:ignore id="graduationChart" class="block h-full w-full"></canvas>
            </div>
        </div>

        <!-- Work/Course Alignment -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6">
            <h3 class="text-lg font-semibold text-[#040405] dark:text-white mb-4">Work/Course Alignment</h3>
            <div class="relative h-64 w-full overflow-hidden">
                <canvas wire:ignore id="alignmentChart" class="block h-full w-full"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div class="text-center p-3 bg-[#b97940]/12 rounded-lg border border-[#b97940]/20">
                    <p class="text-2xl font-bold text-[#b97940]">{{ $workAlignmentData['aligned_percentage'] }}%</p>
                    <p class="text-sm text-[#040405] dark:text-white">Aligned with Course</p>
                    <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $workAlignmentData['aligned'] }} respondents</p>
                </div>
                <div class="text-center p-3 bg-[#731820]/10 rounded-lg border border-[#731820]/20">
                    <p class="text-2xl font-bold text-[#731820]">{{ $workAlignmentData['not_aligned_percentage'] }}%</p>
                    <p class="text-sm text-[#040405] dark:text-white">Not Aligned</p>
                    <p class="text-xs text-[#961a1f] dark:text-[#c0c0c0]">{{ $workAlignmentData['not_aligned'] }} respondents</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses by Respondent Count - Full Width -->
    <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-8 w-full">
        <h3 class="text-lg font-semibold text-[#040405] dark:text-white mb-4">Courses by Respondent Count</h3>
        <div class="relative h-64 w-full overflow-hidden">
            <canvas wire:ignore id="courseChart" class="block h-full w-full"></canvas>
        </div>
    </div>

    <!-- Main Admin Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <!-- Analytics Overview Card -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-[#731820] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-[#731820] dark:text-[#c0c0c0]">ANALYTICS</span>
                </div>
                <h3 class="text-lg font-semibold text-[#040405] dark:text-white mb-2">Analytics</h3>
                <p class="text-sm text-[#731820] dark:text-[#c0c0c0] mb-4 flex-1">View comprehensive reports and analytics</p>
                <a href="{{ route('reports') }}" class="w-full bg-[#040405] hover:bg-[#731820] dark:bg-[#040405] dark:hover:bg-[#731820] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                    View Analytics
                </a>
            </div>
        </div>

        <!-- Data Management Card -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-[#961a1f] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-[#961a1f] dark:text-[#c0c0c0]">DATA</span>
                </div>
                <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Upload Data</h3>
                <p class="text-sm text-[#731820] dark:text-[#c0c0c0] mb-4 flex-1">Manage Excel file uploads and batch processing</p>
                <a href="{{ route('upload') }}" class="w-full bg-[#731820] hover:bg-[#961a1f] dark:bg-[#731820] dark:hover:bg-[#961a1f] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                    Manage Uploads
                </a>
            </div>
        </div>

        <!-- Reports Management Card -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-[#b97940] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#040405]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-[#b97940] dark:text-[#c0c0c0]">REPORTS</span>
                </div>
                <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Reports</h3>
                <p class="text-sm text-[#731820] dark:text-[#c0c0c0] mb-4 flex-1">Generate and manage tracer study reports</p>
                <a href="{{ route('reports') }}" class="w-full bg-[#961a1f] hover:bg-[#731820] dark:bg-[#961a1f] dark:hover:bg-[#731820] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                    Manage Reports
                </a>
            </div>
        </div>

        <!-- User Management Card -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-[#040405] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-[#040405] dark:text-[#c0c0c0]">USERS</span>
                </div>
                <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">User Management</h3>
                <p class="text-sm text-[#731820] dark:text-[#c0c0c0] mb-4 flex-1">Manage user accounts and permissions</p>
                <button class="w-full bg-[#b97940] hover:bg-[#961a1f] text-[#040405] hover:text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Manage Users
                </button>
            </div>
        </div>
    </div>
    
        
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.__adminDashboardChartFactory = () => {
        if (!window.Chart) {
            return;
        }

        window.__adminDashboardChartInstances = window.__adminDashboardChartInstances || {};
        const chartInstances = window.__adminDashboardChartInstances;

        const destroyChart = (key) => {
            if (chartInstances[key]) {
                chartInstances[key].destroy();
                chartInstances[key] = null;
            }
        };

        const isDark = document.documentElement.classList.contains('dark');
        const isRmmc = document.documentElement.classList.contains('theme-rmmc');
        const axisColor = isRmmc ? '#030215' : (isDark ? '#c0c0c0' : '#731820');
        const gridColor = isRmmc ? 'rgba(3, 2, 21, 0.12)' : (isDark ? 'rgba(192, 192, 192, 0.12)' : 'rgba(115, 24, 32, 0.12)');
        const legendColor = isRmmc ? '#030215' : (isDark ? '#c0c0c0' : '#731820');
        const lineStart = isRmmc ? 'rgba(3, 2, 21, 0.9)' : 'rgba(150, 26, 31, 0.85)';
        const lineEnd = isRmmc ? 'rgba(12, 12, 123, 0.18)' : 'rgba(185, 121, 64, 0.18)';
        const doughnutColors = isRmmc ? ['#030215', '#04054f', '#0f0f53', '#0c0c7b'] : ['#b97940', '#731820'];
        const barColor = isRmmc ? '#04054f' : '#961a1f';
        const barBorder = isRmmc ? '#030215' : '#731820';

        const gradCanvas = document.getElementById('graduationChart');
        if (gradCanvas) {
            destroyChart('graduation');
            const gradLabels = @json(array_keys($graduationData));
            const gradData = @json(array_values($graduationData));
            const gradGradient = gradCanvas.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradGradient.addColorStop(0, lineStart);
            gradGradient.addColorStop(1, lineEnd);

            chartInstances.graduation = new Chart(gradCanvas, {
                type: 'line',
                data: {
                    labels: gradLabels,
                    datasets: [{
                        label: 'Graduates',
                        data: gradData,
                        backgroundColor: gradGradient,
                        borderColor: isRmmc ? '#adacc4' : 'rgba(150, 26, 31, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: axisColor },
                            grid: { color: gridColor }
                        },
                        x: {
                            ticks: { color: axisColor },
                            grid: { color: gridColor }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        const alignmentCanvas = document.getElementById('alignmentChart');
        if (alignmentCanvas) {
            destroyChart('alignment');
            const alignmentData = @json([$workAlignmentData['aligned'], $workAlignmentData['not_aligned']]);
            chartInstances.alignment = new Chart(alignmentCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Aligned with Course', 'Not Aligned'],
                    datasets: [{
                        data: alignmentData,
                        backgroundColor: doughnutColors,
                        borderColor: isRmmc ? '#ffffff' : (isDark ? '#040405' : '#f7f4ef'),
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: legendColor }
                        }
                    }
                }
            });
        }

        const courseCanvas = document.getElementById('courseChart');
        if (courseCanvas) {
            destroyChart('course');
            const courseLabels = @json(array_keys($courseDistribution));
            const courseData = @json(array_values($courseDistribution));

            chartInstances.course = new Chart(courseCanvas, {
                type: 'bar',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        label: 'Respondents',
                        data: courseData,
                        backgroundColor: barColor,
                        borderColor: barBorder,
                        borderWidth: 1,
                        barThickness: 20,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { color: axisColor },
                            grid: { color: gridColor }
                        },
                        y: {
                            ticks: { color: axisColor },
                            grid: { color: gridColor }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    };

    if (!window.__adminDashboardChartsBound) {
        window.__adminDashboardChartsBound = true;
        document.addEventListener('DOMContentLoaded', () => window.__adminDashboardChartFactory());
        document.addEventListener('livewire:navigated', () => window.__adminDashboardChartFactory());
        document.addEventListener('livewire:initialized', () => window.__adminDashboardChartFactory());
        window.addEventListener('pageshow', () => window.__adminDashboardChartFactory());
    }

    window.__adminDashboardChartFactory();
</script>
