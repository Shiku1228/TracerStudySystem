<?php

use Livewire\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Appearance Settings') }}</flux:heading>

    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <div
            x-data="{
                appearance: 'system',
                init() {
                    this.appearance = localStorage.getItem('app.appearance') || localStorage.getItem('flux.appearance') || 'system';
                },
                apply(next) {
                    this.appearance = next;

                    if (next === 'rmmc') {
                        localStorage.setItem('app.appearance', 'rmmc');
                        localStorage.setItem('flux.appearance', 'light');
                        document.documentElement.classList.remove('dark');
                        document.documentElement.classList.add('theme-rmmc');
                        return;
                    }

                    document.documentElement.classList.remove('theme-rmmc');

                    if (next === 'system') {
                        localStorage.removeItem('app.appearance');
                        localStorage.removeItem('flux.appearance');
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                        return;
                    }

                    localStorage.setItem('app.appearance', next);
                    localStorage.setItem('flux.appearance', next);

                    if (next === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }"
            x-init="init()"
        >
            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <button type="button" @click="apply('light')" :class="appearance === 'light' ? 'ring-2 ring-[#731820] bg-[#b97940]/20 text-[#040405] dark:text-white' : 'bg-white dark:bg-[#040405] text-[#731820] dark:text-[#c0c0c0]'" class="flex items-center justify-center gap-2 rounded-xl border border-[#731820]/20 px-4 py-3 font-medium transition-all">
                    <flux:icon.sun class="size-4" />
                    <span>{{ __('Light') }}</span>
                </button>

                <button type="button" @click="apply('dark')" :class="appearance === 'dark' ? 'ring-2 ring-[#731820] bg-[#040405] text-white' : 'bg-white dark:bg-[#040405] text-[#731820] dark:text-[#c0c0c0]'" class="flex items-center justify-center gap-2 rounded-xl border border-[#731820]/20 px-4 py-3 font-medium transition-all">
                    <flux:icon.moon class="size-4" />
                    <span>{{ __('Dark') }}</span>
                </button>

                <button type="button" @click="apply('rmmc')" :class="appearance === 'rmmc' ? 'ring-2 ring-[#0c0c7b] bg-[#04054f] text-white' : 'bg-white dark:bg-[#040405] text-[#731820] dark:text-[#c0c0c0]'" class="flex items-center justify-center gap-2 rounded-xl border border-[#731820]/20 px-4 py-3 font-medium transition-all">
                    <span class="inline-flex h-4 w-4 items-center justify-center rounded-full bg-gradient-to-br from-[#81808c] via-[#04054f] to-[#0c0c7b]"></span>
                    <span>{{ __('RMMC') }}</span>
                </button>

                <button type="button" @click="apply('system')" :class="appearance === 'system' ? 'ring-2 ring-[#731820] bg-[#b97940]/15 text-[#040405] dark:text-white' : 'bg-white dark:bg-[#040405] text-[#731820] dark:text-[#c0c0c0]'" class="flex items-center justify-center gap-2 rounded-xl border border-[#731820]/20 px-4 py-3 font-medium transition-all">
                    <flux:icon.computer-desktop class="size-4" />
                    <span>{{ __('System') }}</span>
                </button>
            </div>
        </div>
    </x-pages::settings.layout>
</section>
