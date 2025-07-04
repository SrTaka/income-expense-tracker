<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Income Expense Tracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-[#0f1117]">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-8 bg-[#1a1f2e] shadow-lg overflow-hidden sm:rounded-lg">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Income Expense Tracker</h1>
                    <p class="text-gray-400">Effortlessly track your income and expenditures</p>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
