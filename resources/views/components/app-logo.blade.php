@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Tracer Study System" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center text-[#c0c0c0]">
            <x-app-logo-icon class="size-5 fill-current text-[#c0c0c0] dark:text-[#040405]" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Tracer Study System" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center text-[#c0c0c0]">
            <x-app-logo-icon class="size-5 fill-current text-[#c0c0c0] dark:text-[#040405]" />
        </x-slot>
    </flux:brand>
@endif
