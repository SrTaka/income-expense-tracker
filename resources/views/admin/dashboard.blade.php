<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <div class="dashboard-main">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <!-- Statistics Overview -->
                    <div id="statistics">
                        <div class="dashboard-section">
                            <div class="section-content">
                                <h3 class="section-title">Overview</h3>
                                <div class="statistics-grid">
                                    <div class="stat-card stat-card-blue">
                                        <div class="stat-label text-blue-600 dark:text-blue-400">Total Users</div>
                                        <div class="stat-value text-blue-800 dark:text-blue-300">{{ \App\Models\User::count() }}</div>
                                    </div>
                                    <div class="stat-card stat-card-green">
                                        <div class="stat-label text-green-600 dark:text-green-400">Total Income</div>
                                        <div class="stat-value text-green-800 dark:text-green-300">$0</div>
                                    </div>
                                    <div class="stat-card stat-card-red">
                                        <div class="stat-label text-red-600 dark:text-red-400">Total Expenses</div>
                                        <div class="stat-value text-red-800 dark:text-red-300">$0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div id="recent-users">
                        <div class="dashboard-section">
                            <div class="section-content">
                                <h3 class="section-title">Recent Users</h3>
                                <div class="overflow-x-auto">
                                    <table class="users-table">
                                        <thead class="users-table-header">
                                            <tr>
                                                <th class="users-table-cell text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                                <th class="users-table-cell text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                                <th class="users-table-cell text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                                                <th class="users-table-cell text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joined</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                            <tr>
                                                <td class="users-table-cell text-gray-900 dark:text-white">{{ $user->name }}</td>
                                                <td class="users-table-cell text-gray-900 dark:text-white">{{ $user->email }}</td>
                                                <td class="users-table-cell">
                                                    @foreach($user->roles as $role)
                                                        <span class="role-badge">
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td class="users-table-cell text-gray-900 dark:text-white">{{ $user->created_at->diffForHumans() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div id="quick-actions">
                        <div class="dashboard-section">
                            <div class="section-content">
                                <h3 class="section-title">Quick Actions</h3>
                                <div class="quick-actions-grid">
                                    <a href="{{ route('admin.users.create') }}" class="action-button">
                                        Add New User
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" class="action-button">
                                        View All Users
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" class="action-button">
                                        System Settings
                                    </a>
                                    <a href="{{ route('admin.reports.index') }}" class="action-button">
                                        View Reports
                                    </a>
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
