<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Track Your Finances Effortlessly</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#1a1f2e] text-gray-200 font-sans antialiased flex flex-col min-h-screen">
    <div class="relative sm:flex sm:justify-center sm:items-center bg-[#1a1f2e] selection:bg-green-500 selection:text-white flex-grow">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-green-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500 transition-colors duration-200">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-green-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500 transition-colors duration-200 mr-4">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-300 hover:text-green-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500 transition-colors duration-200">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="mt-8 text-4xl font-bold tracking-tight text-white sm:text-5xl">Take Control of Your Finances</h1>
                <p class="mt-4 text-lg text-gray-300">Effortlessly track your income and expenditures with our intuitive system.</p>
                <div class="mt-8 flex justify-center gap-4">
                    @if (!Route::has('login') || !Auth::check())
                        <a href="{{ route('register') }}" class="inline-flex items-center rounded-md bg-green-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-colors duration-200">
                            Start Free Trial
                        </a>
                        <a href="#" class="inline-flex items-center rounded-md border border-gray-600 bg-[#262b3c] px-6 py-3 text-lg font-semibold text-gray-300 shadow-sm hover:bg-[#2d3344] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-colors duration-200">
                            Explore Features
                        </a>
                        <a href="#" class="inline-flex items-center rounded-md border border-gray-600 bg-[#262b3c] px-6 py-3 text-lg font-semibold text-gray-300 shadow-sm hover:bg-[#2d3344] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-colors duration-200">
                            Contact Us
                        </a>
                    </div>
                @else
                    <a href="{{ url('/dashboard') }}" class="mt-4 inline-flex items-center rounded-md bg-green-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-colors duration-200">
                        Access Your Dashboard
                    </a>
                @endif
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 rounded-lg shadow-md bg-[#262b3c] border border-gray-700">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-400">
                            <path d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"></path>
                            <path d="M20 23V11H4v12l8-4 8 4z"></path>
                        </svg>
                        <h2 class="ml-3 text-xl font-semibold text-white">Intuitive Tracking</h2>
                    </div>
                    <p class="mt-2 text-gray-300">Easily log your income and expenses with a simple and user-friendly interface.</p>
                </div>

                <div class="p-6 rounded-lg shadow-md bg-[#262b3c] border border-gray-700">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-400">
                            <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <h2 class="ml-3 text-xl font-semibold text-white">Visual Insights</h2>
                    </div>
                    <p class="mt-2 text-gray-300">Gain clear insights into your financial health with charts and summaries of your data.</p>
                </div>

                <div class="p-6 rounded-lg shadow-md bg-[#262b3c] border border-gray-700">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-400">
                            <path d="M3 15a4 4 0 004 4h9a4 4 0 004-4V5a4 4 0 00-4-4H7a4 4 0 00-4 4v10zM3 3v18m0-6h18"></path>
                        </svg>
                        <h2 class="ml-3 text-xl font-semibold text-white">Secure and Private</h2>
                    </div>
                    <p class="mt-2 text-gray-300">Your financial data is secure and kept private, ensuring peace of mind.</p>
                </div>

                <div class="p-6 rounded-lg shadow-md bg-[#262b3c] border border-gray-700">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-400">
                            <path d="M8 7h12m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <h2 class="ml-3 text-xl font-semibold text-white">Budgeting Tools (Coming Soon)</h2>
                    </div>
                    <p class="mt-2 text-gray-300">Plan and manage your budget effectively with our upcoming budgeting features.</p>
                </div>
            </div>           
        </div>       
    </div>
    <footer class="py-4 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} Nathan Ngonidzashe Takawira. All rights reserved.
    </footer>
</body>
</html>