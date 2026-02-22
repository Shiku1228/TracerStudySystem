@props(['options', 'model', 'placeholder'])

<div x-data="{ 
    open: false, 
    selected: @entangle($model),
    options: @js($options),
    placeholder: @js($placeholder)
}" class="relative">
    <!-- Select Button -->
    <div @click="open = !open" 
         class="w-full px-3 py-2 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer flex justify-between items-center">
        <span x-text="selected ? options.find(opt => opt.value == selected)?.label || selected : placeholder"></span>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    <!-- Dropdown Options -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-0 w-full mt-1 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 rounded-md shadow-lg overflow-auto" style="max-height: 128px !important;">
        <template x-for="option in options" :key="option.value">
            <div @click="selected = option.value; open = false; $wire.set('{{ $model }}', option.value)"
                 class="px-3 py-1 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-zinc-600 cursor-pointer transition-colors text-sm" style="padding-top: 4px !important; padding-bottom: 4px !important;"
                 :class="{ 'bg-gray-100 dark:bg-zinc-600': selected == option.value }">
                <span x-text="option.label"></span>
            </div>
        </template>
    </div>
</div>
