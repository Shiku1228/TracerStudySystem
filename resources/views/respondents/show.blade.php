<x-layouts::app :title="__('Respondent Profile')">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-6">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('respondents.index') }}" class="inline-flex items-center text-xs text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                    <span class="mr-1">&lt;</span>
                    Back to Respondents
                </a>
            </div>

            <!-- Profile Header -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="px-8 py-10" style="background: linear-gradient(to bottom right, var(--primary-600), var(--primary-700), var(--accent-800))">
                    <div class="flex flex-col items-center space-y-4">
                        <!-- Profile Picture -->
                        <div class="flex-shrink-0">
                            <div class="w-32 h-32 bg-white dark:bg-zinc-800 rounded-full flex items-center justify-center shadow-2xl border-4 border-white/30 dark:border-zinc-700/30 overflow-hidden">
                                <span class="text-5xl font-bold" style="color: var(--primary-600)">
                                    {{ substr($respondent->full_name, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Basic Info -->
                        <div class="text-center flex-1">
                            <h1 class="text-2xl font-bold text-white mb-2">{{ $respondent->full_name }}</h1>
                            <div class="flex items-center justify-center text-center text-sm mb-6 mt-4" style="color: var(--primary-100)">
                                <span>{{ $respondent->course_graduated }}</span>
                                <span class="mx-2">•</span>
                                <span>Class of {{ $respondent->graduation_year }}</span>
                            </div>
                            
                            <!-- Status Badges -->
                            <div class="flex flex-wrap items-center justify-center gap-3 mt-6">
                                @if($respondent->employmentData)
                                    @if($respondent->employmentData->is_presently_employed)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm" style="background-color: rgba(185, 121, 64, 0.2); color: #FDE9CB; border-color: rgba(185, 121, 64, 0.3)">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            Employed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm" style="background-color: rgba(115, 24, 32, 0.2); color: #E1BABA; border-color: rgba(115, 24, 32, 0.3)">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            Unemployed
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-500/20 text-gray-100 dark:bg-gray-400/20 dark:text-gray-300 border border-gray-400/30 dark:border-gray-500/30 backdrop-blur-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        No Data
                                    </span>
                                @endif
                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm" style="background-color: rgba(192, 192, 192, 0.2); color: #F0F0F0; border-color: rgba(192, 192, 192, 0.3)">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ ucfirst($respondent->gender) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Bar -->
                <div class="bg-gray-50 dark:bg-zinc-700/50 px-6 py-5 mt-4">
                    <div class="flex flex-wrap justify-center gap-6 text-xs mb-4">
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-3 h-3 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $respondent->email_address }}</span>
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-3 h-3 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ $respondent->contact_number ?: 'Not provided' }}</span>
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-3 h-3 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $respondent->age ? $respondent->age . ' years old' : 'Age not calculated' }}</span>
                        </div>
                    </div>
                </div>
            </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        <!-- Left Column -->
                        <div class="space-y-12">
                            <!-- Personal Information -->
                            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-2 h-8 bg-gray-500 rounded-full mr-3"></div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h2>
                                </div>
                                <div class="space-y-4">
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Full Name</p>
                                        <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->full_name }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email Address</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->email_address }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Number</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->contact_number ?: 'Not provided' }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Gender</p>
                                        <p class="text-gray-900 dark:text-white">{{ ucfirst($respondent->gender) }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Civil Status</p>
                                        <p class="text-gray-900 dark:text-white">{{ ucfirst($respondent->civil_status) }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Birthday</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->birthday ? $respondent->birthday->format('F d, Y') : 'Not provided' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Age</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->age ?: 'Not calculated' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Education Information -->
                            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-2 h-8 bg-gray-500 rounded-full mr-3"></div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Education Information</h2>
                                </div>
                                <div class="space-y-4">
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Course Graduated</p>
                                        <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->course_graduated }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Course Code</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->course_code }}</p>
                                    </div>
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Graduation Year</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->graduation_year }}</p>
                                    </div>
                                    @if($respondent->batch)
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Batch</p>
                                            <p class="text-gray-900 dark:text-white">{{ $respondent->batch->batch_name }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-12">
                            <!-- Address Information -->
                            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-2 h-8 bg-gray-500 rounded-full mr-3"></div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Address Information</h2>
                                </div>
                                <div class="space-y-4">
                                    <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Present Address</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->present_address ?: 'Not provided' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Provincial Address</p>
                                        <p class="text-gray-900 dark:text-white">{{ $respondent->provincial_address ?: 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Information -->
                            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-2 h-8 bg-gray-500 rounded-full mr-3"></div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Employment Information</h2>
                                </div>
                                @if($respondent->employmentData)
                                    <div class="space-y-4">
                                        <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Employment Status</p>
                                            @if($respondent->employmentData->is_presently_employed)
                                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full" style="background-color: var(--secondary-100); color: var(--secondary-800)">
                                                    Employed
                                                </span>
                                            @else
                                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full" style="background-color: var(--accent-100); color: var(--accent-800)">
                                                    Unemployed
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">First Job After College</p>
                                            <p class="text-gray-900 dark:text-white font-medium">
                                                @if($respondent->employmentData->is_first_job === true)
                                                    Yes
                                                @elseif($respondent->employmentData->is_first_job === false)
                                                    No
                                                @else
                                                    Not specified
                                                @endif
                                            </p>
                                        </div>

                                        @if($respondent->employmentData->is_presently_employed)
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 mt-4">Current Employment Details</h3>
                                            </div>
                                            
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Present Occupation</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->present_occupation ?: 'Not provided' }}</p>
                                            </div>
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Company</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->company_name ?: 'Not provided' }}</p>
                                            </div>
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Position/Designation</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->position_designation ?: 'Not provided' }}</p>
                                            </div>
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Work Location</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->work_location }}</p>
                                            </div>
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Company Address/Contact</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->company_address_contact ?: 'Not provided' }}</p>
                                            </div>
                                            <div class="pb-3 border-b border-gray-100 dark:border-zinc-700">
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Professional Skills</p>
                                                <p class="text-gray-900 dark:text-white font-medium">{{ $respondent->employmentData->professional_skills ?: 'Not provided' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Course Related</p>
                                                <p class="text-gray-900 dark:text-white font-medium">
                                                    @if($respondent->employmentData->is_course_related === true)
                                                        Yes, course-related
                                                    @elseif($respondent->employmentData->is_course_related === false)
                                                        No, not course-related
                                                    @else
                                                        Not specified
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No employment data available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
