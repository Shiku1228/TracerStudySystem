<x-layouts::app :title="__('Student Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Student Dashboard</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Welcome back! Here's your learning progress</p>
        </div>
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Courses</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">View your courses</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Assignments</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Track assignments</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Grades</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Check your grades</p>
                </div>
            </div>
        </div>
        
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Learning Progress</h2>
            <div class="space-y-4">
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Course Completion</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">75%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Assignments Completed</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">8/10</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Study Streak</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">12 days</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-600 h-2 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
