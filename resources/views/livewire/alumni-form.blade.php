<div class="min-h-screen bg-white dark:bg-zinc-900 text-gray-900 dark:text-white overflow-y-auto">
    @if (session()->has('message'))
        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6 pb-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Alumni Profile Registration</h2>
            
            <!-- Personal Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-zinc-200">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Student ID</label>
                        <input type="text" wire:model="student_id" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('student_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">First Name</label>
                        <input type="text" wire:model="first_name" readonly class="w-full px-3 py-2 bg-gray-100 dark:bg-zinc-600 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Prefilled from registration">
                        @error('first_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Last Name</label>
                        <input type="text" wire:model="last_name" readonly class="w-full px-3 py-2 bg-gray-100 dark:bg-zinc-600 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Prefilled from registration">
                        @error('last_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Middle Name (Optional)</label>
                        <input type="text" wire:model="middle_name" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('middle_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Birth Date</label>
                        <input type="date" wire:model="birth_date" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('birth_date') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Gender</label>
                        <x-custom-select :options="$genderOptions" model="gender" placeholder="Select Gender" />
                        @error('gender') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Phone</label>
                        <input type="text" wire:model="phone" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Address</label>
                        <textarea wire:model="address" rows="3" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        @error('address') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-zinc-200">Academic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Course</label>
                        <input type="text" wire:model="course" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('course') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Major</label>
                        <input type="text" wire:model="major" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('major') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Batch Year</label>
                        <input type="number" wire:model="batch_year" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('batch_year') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Graduation Date</label>
                        <input type="date" wire:model="graduation_date" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('graduation_date') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">GPA (Optional)</label>
                        <input type="number" step="0.01" wire:model="gpa" class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('gpa') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Current Status</label>
                        <x-custom-select :options="$statusOptions" model="status" placeholder="Select Status" />
                        @error('status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pr-4 w-full">
                <button type="submit" class="bg-blue-600 dark:bg-blue-500 text-gray-100 dark:text-white font-bold px-6 py-2 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 cursor-pointer border-2 border-blue-700 dark:border-blue-400" wire:loading.attr="disabled">
                    <span wire:loading.remove>Create Alumni Profile</span>
                    <span wire:loading>Creating...</span>
                </button>
            </div>
        </div>
    </form>
</div>
