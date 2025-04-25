<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex space-x-2">
                <x-primary-button onclick="window.location.href='{{ route('admin.notifications') }}'">
                    <i class="fas fa-bell mr-2"></i> Notifications
                </x-primary-button>
                <x-secondary-button onclick="window.location.href='{{ route('admin.settings.index') }}'">
                    <i class="fas fa-cog mr-2"></i> Settings
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Welcome Banner -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="welcome-banner bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg mb-6 shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}!</h3>
                        <p class="opacity-90">Here's what's happening with your platform today.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm opacity-80">Last login: {{ Auth::user()->last_login_at?->diffForHumans() ?? 'Never' }}</p>
                        <p class="text-sm opacity-80">Current time: {{ now()->format('g:i A, M j, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Statistics Overview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Platform Overview</h3>
                        <select id="time-period" class="text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="today">Today</option>
                            <option value="week" selected>This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="stat-card">
                            <div class="stat-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Total Users</div>
                                <div class="stat-value">{{ \App\Models\User::count() }}</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 12% from last week
                                </div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon bg-green-100 text-green-600">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Total Income</div>
                                <div class="stat-value">${{ number_format(12500, 2) }}</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 8% from last week
                                </div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon bg-purple-100 text-purple-600">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">New Orders</div>
                                <div class="stat-value">42</div>
                                <div class="stat-change negative">
                                    <i class="fas fa-arrow-down"></i> 3% from last week
                                </div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon bg-red-100 text-red-600">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-label">Pending Tickets</div>
                                <div class="stat-value">18</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> 5% from last week
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity and Users -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Users -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Users</h3>
                                <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View All</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <img class="h-8 w-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="">
                                                    <div class="ml-4">
                                                        <div class="text-sm leading-5 font-medium text-gray-900 dark:text-white">
                                                            {{ $user->name }}
                                                        </div>
                                                        <div class="text-sm leading-5 text-gray-500 dark:text-gray-400">
                                                            Joined {{ $user->created_at->format('M j, Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900 dark:text-white">{{ $user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                                <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                                <button class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Activity</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-900 dark:text-white">New user registered</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">2 minutes ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-900 dark:text-white">New payment received</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">15 minutes ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-900 dark:text-white">System alert</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                                <i class="fas fa-user-plus mr-2"></i> Add User
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                                <i class="fas fa-plus-circle mr-2"></i> Add Product
                            </a>
                            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:outline-none focus:border-purple-700 focus:ring focus:ring-purple-200 active:bg-purple-600 disabled:opacity-25 transition">
                                <i class="fas fa-chart-bar mr-2"></i> Reports
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-600 disabled:opacity-25 transition">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">System Status</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Server Status</span>
                                </div>
                                <span class="text-sm text-green-600 dark:text-green-400">Operational</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Database</span>
                                </div>
                                <span class="text-sm text-green-600 dark:text-green-400">Connected</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Storage</span>
                                </div>
                                <span class="text-sm text-yellow-600 dark:text-yellow-400">75% Used</span>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-700 dark:text-gray-300 mb-1">
                                    <span>Memory Usage</span>
                                    <span>2.4/4 GB</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/css/app.css'])
</x-app-layout>