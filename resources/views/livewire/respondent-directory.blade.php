<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="card-surface dark:card-surface-dark rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#731820] dark:text-[#c0c0c0]">Total Respondents</p>
                    <p class="text-2xl font-bold text-[#040405] dark:text-white mt-1">{{ $statistics['total'] }}</p>
                </div>
                <div class="flex-shrink-0">
                    <svg class="w-10 h-10 text-[#731820] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-surface dark:card-surface-dark rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#961a1f] dark:text-[#c0c0c0]">Employed</p>
                    <p class="text-2xl font-bold text-[#040405] dark:text-white mt-1">{{ $statistics['employed'] }}</p>
                </div>
                <div class="flex-shrink-0">
                    <svg class="w-10 h-10 text-[#961a1f] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-surface dark:card-surface-dark rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#b97940] dark:text-[#c0c0c0]">Unemployed</p>
                    <p class="text-2xl font-bold text-[#040405] dark:text-white mt-1">{{ $statistics['unemployed'] }}</p>
                </div>
                <div class="flex-shrink-0">
                    <svg class="w-10 h-10 text-[#b97940] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.562M15 6.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-surface dark:card-surface-dark rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#040405] dark:text-[#c0c0c0]">Employment Rate</p>
                    <p class="text-2xl font-bold text-[#040405] dark:text-white mt-1">{{ $statistics['employment_rate'] }}%</p>
                </div>
                <div class="flex-shrink-0">
                    <svg class="w-10 h-10 text-[#040405] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-6">
        <div class="mb-6">
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search respondents by name..."
                    class="w-full pl-4 pr-12 py-3 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent"
                >
                <div class="absolute right-4 top-3 pointer-events-none">
                    <svg class="w-5 h-5 text-[#731820] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-[#731820] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-[#040405] dark:text-white">Filters</h3>
            </div>
            <button wire:click="clearFilters" class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#040405] dark:text-[#c0c0c0] bg-[#b97940]/15 dark:bg-[#731820] rounded-lg hover:bg-[#b97940]/25 dark:hover:bg-[#961a1f] transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#731820] dark:text-[#c0c0c0] mb-1">Course</label>
                <select wire:model.live="selectedCourse" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course }}">{{ $course }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#961a1f] dark:text-[#c0c0c0] mb-1">Year</label>
                <select wire:model.live="selectedYear" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Years</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#b97940] dark:text-[#c0c0c0] mb-1">Status</label>
                <select wire:model.live="selectedEmploymentStatus" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Status</option>
                    <option value="employed">Employed</option>
                    <option value="unemployed">Unemployed</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#040405] dark:text-[#c0c0c0] mb-1">Location</label>
                <select wire:model.live="selectedWorkLocation" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Locations</option>
                    <option value="local">Local</option>
                    <option value="abroad">Abroad</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#731820] dark:text-[#c0c0c0] mb-1">Gender</label>
                <select wire:model.live="selectedGender" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Genders</option>
                    @foreach($genders as $gender)
                        <option value="{{ $gender }}">{{ ucfirst($gender) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#b97940] dark:text-[#c0c0c0] mb-1">Civil Status</label>
                <select wire:model.live="selectedCivilStatus" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Civil Status</option>
                    @foreach($civilStatuses as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#040405] dark:text-[#c0c0c0] mb-1">Batch</label>
                <select wire:model.live="selectedBatch" class="w-full px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#731820] dark:text-[#c0c0c0] mb-1">Sort</label>
                <div class="flex space-x-2">
                    <select wire:model.live="sortBy" class="flex-1 px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                        <option value="graduation_year">Year</option>
                        <option value="full_name">Name</option>
                        <option value="created_at">Date</option>
                    </select>
                    <select wire:model.live="sortOrder" class="px-3 py-2 border border-[#731820]/20 dark:border-[#731820]/40 bg-[#f7f4ef] dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#731820] focus:border-transparent text-sm">
                        <option value="desc">↓</option>
                        <option value="asc">↑</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-surface dark:card-surface-dark rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-[#731820]/15 dark:border-[#731820]/30">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-[#040405] dark:text-white">Results</h3>
                    <p class="text-sm text-[#731820] dark:text-[#c0c0c0] mt-1">
                        @if($respondents->total() > 0)
                            {{ $respondents->firstItem() }}-{{ $respondents->lastItem() }} of {{ $respondents->total() }} respondents
                        @else
                            No respondents found
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#731820]/10 dark:divide-[#731820]/30">
                <thead class="bg-[#b97940]/10 dark:bg-[#040405]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Year</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-[#f7f4ef] dark:bg-[#040405] divide-y divide-[#731820]/10 dark:divide-[#731820]/30">
                    @forelse($respondents as $respondent)
                        <tr class="hover:bg-[#b97940]/8 dark:hover:bg-[#731820]/15 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-[#731820] flex items-center justify-center">
                                            <span class="text-xs font-medium text-white">{{ substr($respondent->full_name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-[#040405] dark:text-white">{{ $respondent->full_name }}</div>
                                        <div class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $respondent->course_code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[#040405] dark:text-white">{{ Str::limit($respondent->course_graduated, 20) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[#040405] dark:text-white">{{ $respondent->graduation_year }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[#040405] dark:text-white truncate max-w-xs">{{ $respondent->email_address }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($respondent->employmentData)
                                    @if($respondent->employmentData->is_presently_employed)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#b97940]/15 text-[#731820] dark:bg-[#b97940]/20 dark:text-[#c0c0c0]">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Employed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#961a1f]/10 text-[#961a1f] dark:bg-[#961a1f]/20 dark:text-[#c0c0c0]">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Unemployed
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#040405]/5 text-[#040405] dark:bg-[#731820] dark:text-[#c0c0c0]">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        No Data
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($respondent->employmentData)
                                    <span class="inline-flex items-center text-sm text-[#040405] dark:text-white">
                                        @if($respondent->employmentData->place_of_work === 'local')
                                            <svg class="w-4 h-4 mr-1 text-[#961a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Local
                                        @else
                                            <svg class="w-4 h-4 mr-1 text-[#b97940]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                            </svg>
                                            Abroad
                                        @endif
                                    </span>
                                @else
                                    <span class="text-sm text-[#731820] dark:text-[#c0c0c0]">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('respondents.show', $respondent->id) }}" class="inline-flex items-center text-[#731820] dark:text-[#c0c0c0] hover:text-[#040405] dark:hover:text-white transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-[#731820] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.562M15 6.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-[#040405] dark:text-white">No respondents found</h3>
                                <p class="mt-1 text-sm text-[#731820] dark:text-[#c0c0c0]">Try adjusting your search or filter criteria</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($respondents->hasPages())
            <div class="bg-[#f7f4ef] dark:bg-[#040405] px-6 py-4 border-t border-[#731820]/15 dark:border-[#731820]/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-[#040405] dark:text-[#c0c0c0]">
                        Showing <span class="font-medium">{{ $respondents->firstItem() }}</span> to
                        <span class="font-medium">{{ $respondents->lastItem() }}</span> of
                        <span class="font-medium">{{ $respondents->total() }}</span> results
                    </div>
                    <div class="flex items-center space-x-2 ml-8">
                        {{ $respondents->links('vendor.pagination.custom-monochrome') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
