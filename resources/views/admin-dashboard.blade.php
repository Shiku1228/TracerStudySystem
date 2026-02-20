<x-layouts::app :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Manage your application from here</p>
        </div>
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Users</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage user accounts</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Analytics</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">View system statistics</p>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
                <div class="flex flex-col items-center justify-center h-full">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Settings</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Configure system</p>
                </div>
            </div>
        </div>
        
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-gray-800 p-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h2>
            <div class="space-y-3">
                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">System running normally</span>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Last backup: 2 hours ago</span>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">5 pending user approvals</span>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
