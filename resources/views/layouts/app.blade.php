<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Income Expense Tracker') }}</title>

        <!-- Theme Script - Must run before page load -->
        <script>
            // Check for saved theme preference or use system preference
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-[#0f1117] text-gray-800 dark:text-gray-200 min-h-screen transition-colors duration-200">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-[#1a1f2e] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Theme Toggle -->
        <div class="fixed bottom-4 right-4 z-50">
            <button id="themeToggle" class="p-2 rounded-full bg-[#1a1f2e] dark:bg-gray-200 text-gray-200 dark:text-gray-800 shadow-lg hover:bg-[#262b3c] dark:hover:bg-gray-300 transition-colors duration-200">
                <!-- Moon icon for dark mode -->
                <svg id="darkIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                <!-- Sun icon for light mode -->
                <svg id="lightIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>
        </div>

        <script>
            // Theme toggle functionality
            document.addEventListener('DOMContentLoaded', function() {
                const themeToggle = document.getElementById('themeToggle');
                const darkIcon = document.getElementById('darkIcon');
                const lightIcon = document.getElementById('lightIcon');
                const html = document.documentElement;

                // Function to update theme
                function updateTheme(isDark) {
                    if (isDark) {
                        html.classList.add('dark');
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    } else {
                        html.classList.remove('dark');
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    }
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                }

                // Set initial icon state
                updateTheme(html.classList.contains('dark'));

                // Handle theme toggle click
                themeToggle.addEventListener('click', () => {
                    const isDark = !html.classList.contains('dark');
                    updateTheme(isDark);
                });

                // Handle system theme changes
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!localStorage.getItem('theme')) {
                        updateTheme(e.matches);
                    }
                });
            });
        </script>
    </body>
</html>
