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

    <div class="dashboard-container">
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <div class="dashboard-main">
            <div class="py-6">
                <!-- Welcome Banner -->
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

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <!-- Statistics Overview -->
                    <div id="statistics">
                        <div class="dashboard-section">
                            <div class="section-content">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="section-title">Platform Overview</h3>
                                    <select id="time-period" class="text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                        <option value="today">Today</option>
                                        <option value="week" selected>This Week</option>
                                        <option value="month">This Month</option>
                                        <option value="year">This Year</option>
                                    </select>
                                </div>
                                <div class="statistics-grid">
                                    <div class="stat-card stat-card-blue">
                                        <div class="stat-icon">
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
                                    <div class="stat-card stat-card-green">
                                        <div class="stat-icon">
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
                                    <div class="stat-card stat-card-purple">
                                        <div class="stat-icon">
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
                                    <div class="stat-card stat-card-red">
                                        <div class="stat-icon">
                                            <i class="fas fa-file-alt"></i>
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
                        </div>
                    </div>

                    <!-- Recent Activity Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Recent Users -->
                        <div class="lg:col-span-2">
                            <div class="dashboard-section">
                                <div class="section-content">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="section-title">Recent Users</h3>
                                        <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View All</a>
                                    </div>
                                    <div class="overflow-x-auto rounded-lg shadow">
                                        <table class="users-table">
                                            <thead class="users-table-header">
                                                <tr>
                                                    <th class="users-table-cell">User</th>
                                                    <th class="users-table-cell">Email</th>
                                                    <th class="users-table-cell">Status</th>
                                                    <th class="users-table-cell">Joined</th>
                                                    <th class="users-table-cell">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                                <tr>
                                                    <td class="users-table-cell">
                                                        <div class="flex items-center">
                                                            <img class="w-8 h-8 rounded-full mr-3" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                                            <div>
                                                                <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                    @foreach($user->roles as $role)
                                                                        <span class="role-badge">
                                                                            {{ $role->name }}
                                                                        </span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="users-table-cell text-gray-900 dark:text-white">{{ $user->email }}</td>
                                                    <td class="users-table-cell">
                                                        <span class="status-badge {{ $user->email_verified_at ? 'status-active' : 'status-pending' }}">
                                                            {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                                        </span>
                                                    </td>
                                                    <td class="users-table-cell text-gray-900 dark:text-white">{{ $user->created_at->format('M j, Y') }}</td>
                                                    <td class="users-table-cell">
                                                        <button class="action-icon text-blue-600 hover:text-blue-800 dark:hover:text-blue-400" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="action-icon text-red-600 hover:text-red-800 dark:hover:text-red-400 ml-2" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div>
                            <div class="dashboard-section">
                                <div class="section-content">
                                    <h3 class="section-title">Recent Activity</h3>
                                    <div class="activity-feed">
                                        <div class="activity-item">
                                            <div class="activity-icon bg-blue-100 text-blue-600">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="activity-text">New user registered: <strong>John Doe</strong></p>
                                                <p class="activity-time">2 minutes ago</p>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="activity-icon bg-green-100 text-green-600">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="activity-text">New order #<strong>1245</strong> placed</p>
                                                <p class="activity-time">15 minutes ago</p>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="activity-icon bg-purple-100 text-purple-600">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="activity-text">New support ticket submitted</p>
                                                <p class="activity-time">1 hour ago</p>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="activity-icon bg-yellow-100 text-yellow-600">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="activity-text">System warning: High server load</p>
                                                <p class="activity-time">3 hours ago</p>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="activity-icon bg-indigo-100 text-indigo-600">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="activity-text">Database backup completed</p>
                                                <p class="activity-time">Yesterday</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions & System Status -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Quick Actions -->
                        <div>
                            <div class="dashboard-section">
                                <div class="section-content">
                                    <h3 class="section-title">Quick Actions</h3>
                                    <div class="quick-actions-grid">
                                        <a href="{{ route('admin.users.create') }}" class="action-button">
                                            <i class="fas fa-user-plus mr-2"></i> Add New User
                                        </a>
                                        <a href="{{ route('admin.users.index') }}" class="action-button">
                                            <i class="fas fa-users mr-2"></i> Manage Users
                                        </a>
                                        <a href="{{ route('admin.products.create') }}" class="action-button">
                                            <i class="fas fa-plus-circle mr-2"></i> Add Product
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="action-button">
                                            <i class="fas fa-shopping-bag mr-2"></i> View Orders
                                        </a>
                                        <a href="{{ route('admin.reports.index') }}" class="action-button">
                                            <i class="fas fa-chart-bar mr-2"></i> Generate Reports
                                        </a>
                                        <a href="{{ route('admin.settings.index') }}" class="action-button">
                                            <i class="fas fa-cogs mr-2"></i> System Settings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- System Status -->
                        <div>
                            <div class="dashboard-section">
                                <div class="section-content">
                                    <h3 class="section-title">System Status</h3>
                                    <div class="system-status">
                                        <div class="status-item">
                                            <div class="status-indicator bg-green-500"></div>
                                            <div class="status-label">Web Server</div>
                                            <div class="status-value">Running</div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-indicator bg-green-500"></div>
                                            <div class="status-label">Database</div>
                                            <div class="status-value">Online</div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-indicator bg-yellow-500"></div>
                                            <div class="status-label">Storage</div>
                                            <div class="status-value">75% used</div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-indicator bg-green-500"></div>
                                            <div class="status-label">Memory</div>
                                            <div class="status-value">2.4/4 GB</div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-indicator bg-red-500"></div>
                                            <div class="status-label">Backups</div>
                                            <div class="status-value">Overdue</div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-indicator bg-green-500"></div>
                                            <div class="status-label">Last Backup</div>
                                            <div class="status-value">24 hours ago</div>
                                        </div>
                                    </div>
                                    <div class="mt-4 bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium">System Storage</span>
                                            <span class="text-sm">75% used</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5">
                                            <div class="bg-gradient-to-r from-yellow-400 to-red-500 h-2.5 rounded-full" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</x-app-layout>