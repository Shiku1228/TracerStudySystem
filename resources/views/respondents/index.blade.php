<x-layouts::app :title="__('Respondent Directory')">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-gray-900 dark:text-gray-100" style="font-size: 3rem; line-height: 1.2; font-weight: 900; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Respondent Directory</h1>
                    <p class="mt-1 text-sm text-gray-600">Browse and search through all alumni respondents</p>
                </div>
            </div>

            <livewire:respondent-directory />
        </div>
    </div>
</x-layouts::app>
