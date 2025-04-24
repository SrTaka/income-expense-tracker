<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="space-y-4">
                    <!-- Notifications will be listed here -->
                    <div class="text-gray-600 dark:text-gray-400">
                        No new notifications.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 