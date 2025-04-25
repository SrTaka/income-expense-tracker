<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $header ?? 'Admin Panel' }}
            </h2>
            <div class="flex space-x-2">
                <x-nav-link href="{{ route('admin.notifications') }}" :active="request()->routeIs('admin.notifications')">
                    <i class="fas fa-bell mr-2"></i> Notifications
                </x-nav-link>
                <x-nav-link href="{{ route('admin.settings.index') }}" :active="request()->routeIs('admin.settings.*')">
                    <i class="fas fa-cog mr-2"></i> Settings
                </x-nav-link>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Admin Navigation -->
            <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <nav class="flex space-x-4">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <i class="fas fa-chart-line mr-2"></i> Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                            <i class="fas fa-users mr-2"></i> Users
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')">
                            <i class="fas fa-shopping-cart mr-2"></i> Orders
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.products.create') }}" :active="request()->routeIs('admin.products.*')">
                            <i class="fas fa-box mr-2"></i> Products
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.reports.index') }}" :active="request()->routeIs('admin.reports.*')">
                            <i class="fas fa-chart-bar mr-2"></i> Reports
                        </x-nav-link>
                    </nav>
                </div>
            </div>

            <!-- Page Stats -->
            @hasSection('stats')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @yield('stats')
            </div>
            @endif

            <!-- Main Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @yield('content')
                </div>
            </div>

            <!-- Additional Content -->
            @hasSection('additional')
            <div class="mt-6">
                @yield('additional')
            </div>
            @endif
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</x-app-layout> 