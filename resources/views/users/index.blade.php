<x-layouts::app :title="__('User Management')">
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-[#040405] dark:text-[#c0c0c0]" style="font-size: 3rem; line-height: 1.2; font-weight: 900; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">User Management</h1>
            <p class="text-[#731820] dark:text-[#c0c0c0] mt-2">Manage system users and their roles</p>
        </div>

        <!-- Stats Cards - Monochrome like Dashboard -->
        <div class="flex flex-col lg:flex-row gap-4 mb-8">
            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#c0c0c0]">Total Users</p>
                        <p class="text-2xl font-bold text-white">{{ $users->total() }}</p>
                    </div>
                    <div class="bg-[#731820] p-2 rounded-lg">
                        <svg class="w-5 h-5 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#c0c0c0]">Active Users</p>
                        <p class="text-2xl font-bold text-white">{{ $users->where('email_verified_at', '!=', null)->count() }}</p>
                    </div>
                    <div class="bg-[#961a1f] p-2 rounded-lg">
                        <svg class="w-5 h-5 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#731820] dark:text-[#c0c0c0]">Admins</p>
                        <p class="text-2xl font-bold text-[#040405] dark:text-white">{{ $users->where('role', 'admin')->count() }}</p>
                    </div>
                    <div class="bg-[#040405] p-2 rounded-lg">
                        <svg class="w-5 h-5 text-[#c0c0c0] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex-1 card-surface dark:card-surface-dark rounded-xl p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-[#c0c0c0]">New This Month</p>
                        <p class="text-2xl font-bold text-white">{{ $users->where('created_at', '>=', now()->subMonth())->count() }}</p>
                    </div>
                    <div class="bg-[#731820] p-2 rounded-lg">
                        <svg class="w-5 h-5 text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card-surface dark:card-surface-dark rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-[#731820]/15">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-[#731820]/10 rounded-lg">
                            <svg class="w-5 h-5 text-[#731820] dark:text-[#c0c0c0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#040405] dark:text-white">All Users</h3>
                            <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">Manage user accounts and permissions</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 bg-white dark:bg-[#040405] border border-[#731820]/20 rounded-lg text-sm focus:ring-2 focus:ring-[#731820] w-64 text-[#040405] dark:text-[#c0c0c0]">
                            <svg class="w-4 h-4 text-[#731820] dark:text-[#c0c0c0] absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#b97940]/10 dark:bg-[#040405]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-[#731820] uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-[#731820] uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-[#731820] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-[#731820] uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-[#731820] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#731820]/20">
                        @foreach($users as $user)
                        <tr class="hover:bg-[#b97940]/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#731820] text-[#c0c0c0] flex items-center justify-center font-semibold text-sm shadow-sm">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-[#040405] dark:text-[#c0c0c0]">{{ $user->name }}</p>
                                        <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#040405] text-white">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#b97940]/15 text-[#040405] dark:bg-[#731820] dark:text-[#c0c0c0]">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#b97940]/15 text-[#731820]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#731820]"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#961a1f]/10 text-[#961a1f]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#961a1f]"></span>
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-[#731820] dark:text-[#c0c0c0]">{{ $user->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('users.show', $user) }}" class="p-2 text-[#731820] hover:text-[#040405] hover:bg-[#b97940]/20 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <button class="p-2 text-[#731820] hover:text-[#040405] hover:bg-[#b97940]/20 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button class="p-2 text-[#961a1f] hover:text-white hover:bg-[#961a1f] rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-[#731820]/20">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>
