<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen page-surface text-[#040405] dark:bg-[#040405] dark:text-[#c0c0c0]">
        <flux:header container class="border-b border-[#731820] bg-[#f7f4ef] text-[#040405] dark:border-[#731820] dark:bg-[#040405] dark:text-[#c0c0c0]">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                <flux:tooltip :content="__('Analytics Portal')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="chart-bar"
                        href="{{ route('dashboard') }}"
                        target="_self"
                        :label="__('Analytics Portal')"
                    />
                </flux:tooltip>

                <flux:tooltip :content="__('Admin Guide')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open"
                        href="#"
                        target="_self"
                        :label="__('Admin Guide')"
                    />
                </flux:tooltip>
            </flux:navbar>

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-[#731820] bg-[#f7f4ef] text-[#040405] dark:border-[#731820] dark:bg-[#040405] dark:text-[#c0c0c0]">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="chart-bar" href="{{ route('dashboard') }}" target="_self">
                    {{ __('Analytics Portal') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open" href="#" target="_self">
                    {{ __('Admin Guide') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
