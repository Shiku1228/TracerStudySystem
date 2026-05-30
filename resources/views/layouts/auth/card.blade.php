<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#c0c0c0] antialiased dark:bg-[#040405]">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 bg-[radial-gradient(circle_at_top,_rgba(150,26,31,0.18),_transparent_55%),linear-gradient(180deg,_rgba(4,4,5,0.08),_transparent)] dark:bg-[radial-gradient(circle_at_top,_rgba(150,26,31,0.25),_transparent_45%),linear-gradient(180deg,_rgba(4,4,5,0.4),_rgba(4,4,5,1))]">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-[#c0c0c0] dark:bg-[#040405] border-[#731820] text-[#040405] dark:text-[#c0c0c0] shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
