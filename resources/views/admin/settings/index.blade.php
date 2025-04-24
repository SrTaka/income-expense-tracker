<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Site Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Site Information</h3>
                        
                        <div>
                            <x-label for="site_name" value="{{ __('Site Name') }}" />
                            <x-input id="site_name" name="site_name" type="text" class="mt-1 block w-full"
                                value="{{ setting('site_name', config('app.name')) }}" />
                            <x-input-error for="site_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="site_description" value="{{ __('Site Description') }}" />
                            <textarea id="site_description" name="site_description"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                rows="3">{{ setting('site_description') }}</textarea>
                            <x-input-error for="site_description" class="mt-2" />
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Contact Information</h3>
                        
                        <div>
                            <x-label for="contact_email" value="{{ __('Contact Email') }}" />
                            <x-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full"
                                value="{{ setting('contact_email') }}" />
                            <x-input-error for="contact_email" class="mt-2" />
                        </div>
                    </div>

                    <!-- Display Settings -->
                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Display Settings</h3>
                        
                        <div>
                            <x-label for="items_per_page" value="{{ __('Items Per Page') }}" />
                            <x-input id="items_per_page" name="items_per_page" type="number" class="mt-1 block w-full"
                                value="{{ setting('items_per_page', 15) }}" min="5" max="100" />
                            <x-input-error for="items_per_page" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-button>
                            {{ __('Save Settings') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 