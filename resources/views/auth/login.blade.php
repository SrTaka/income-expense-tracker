<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#1a1f2e]">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#262b3c] shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-gray-200" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" class="text-gray-100 font-medium text-sm tracking-wide" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" class="text-gray-100 font-medium text-sm tracking-wide" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500"
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-[#1a1f2e] border-gray-600 text-green-400 focus:ring-green-400">
                        <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-300 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 transition-colors duration-200" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a class="text-sm text-gray-300 hover:text-green-400 me-4 transition-colors duration-200" href="{{ route('register') }}">
                        {{ __('Need an account?') }}
                    </a>

                    <x-primary-button class="bg-green-600 hover:bg-green-500 text-white font-medium py-2 px-4 rounded transition-colors duration-200">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>