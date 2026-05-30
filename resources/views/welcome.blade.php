<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tracer Study System</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
    </head>
    <body class="page-surface dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] min-h-screen flex flex-col font-['Inter',sans-serif]">
        <!-- Navigation -->
        <header class="w-full border-b border-[#731820] bg-white/80 dark:border-[#731820] dark:bg-[#040405] backdrop-blur">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#731820] rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('app/logo.png') }}" alt="Tracer Study System" class="w-full h-full object-cover">
                    </div>
                    <span class="font-semibold text-lg text-[#c0c0c0]">Tracer Study System</span>
                </div>
                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2 bg-[#040405] dark:bg-[#c0c0c0] text-white dark:text-[#040405] rounded-lg font-medium hover:scale-105 transition-all">
                                <span>Dashboard</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-1 flex flex-col">
            <section class="w-full py-16 lg:py-24 border-b border-[#731820]">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-6">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-[#961a1f] animate-pulse"></div>
                                <span class="text-xs font-medium text-[#731820] dark:text-[#c0c0c0] uppercase tracking-wider">System Online</span>
                            </div>
                            <h1 class="text-[#040405] dark:text-[#c0c0c0]" style="font-size: 3.5rem; line-height: 1.1; font-weight: 900; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                                Tracer Study<br>System
                            </h1>
                            <p class="text-xl text-[#731820] dark:text-[#c0c0c0] max-w-lg">
                                Track, analyze, and connect with graduate success stories. A comprehensive platform for institutional research and alumni engagement.
                            </p>
                            <div class="flex items-center gap-4 pt-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#731820] hover:bg-[#961a1f] text-white rounded-lg font-semibold hover:scale-105 transition-all shadow-lg">
                                        <span>Go to Dashboard</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#040405] hover:bg-[#731820] text-white rounded-lg font-semibold hover:scale-105 transition-all shadow-lg">
                                        <span>Sign In</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="relative">
                            <div class="relative rounded-xl overflow-hidden border border-[#731820] shadow-2xl bg-[#040405] flex items-center justify-center p-8 min-h-[420px]">
                                <img src="{{ asset('app/logo.png') }}" alt="Tracer Study System" class="max-w-full max-h-[520px] w-auto h-auto object-contain transition-transform duration-500 hover:scale-105">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Grid -->
            <section class="w-full py-16">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-[#040405] dark:text-[#c0c0c0] mb-4">Powerful Features</h2>
                        <p class="text-[#731820] dark:text-[#c0c0c0] max-w-2xl mx-auto">Everything you need to track graduate outcomes and build meaningful connections with alumni.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#731820] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Bulk Data Upload</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Import graduate records via Excel/CSV with intelligent field mapping and validation.</p>
                        </div>
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#961a1f] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Advanced Analytics</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Generate comprehensive reports with employment statistics and trend analysis.</p>
                        </div>
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#b97940] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#040405]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">User Management</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Role-based access control with admin and user permissions for secure data handling.</p>
                        </div>
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#731820] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Custom Reports</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Create tailored reports with filters for batch, course, year, and employment status.</p>
                        </div>
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#961a1f] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Secure & Private</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Enterprise-grade security with encrypted data storage and secure authentication.</p>
                        </div>
                        <div class="card-surface dark:card-surface-dark rounded-xl p-6 hover:scale-105 transition-all">
                            <div class="w-12 h-12 bg-[#b97940] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-6 h-6 text-[#040405]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-2">Real-time Insights</h3>
                            <p class="text-[#731820] dark:text-[#c0c0c0] text-sm">Live dashboard with up-to-date statistics and interactive data visualization.</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <footer class="w-full border-t border-[#731820] bg-white/80 dark:bg-[#040405] py-8 backdrop-blur">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-[#731820] rounded flex items-center justify-center overflow-hidden">
                        <x-app-logo-icon class="size-4" />
                    </div>
                    <span class="text-sm text-[#c0c0c0]">Tracer Study System</span>
                </div>
                <p class="text-sm text-[#c0c0c0]">2026 All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
