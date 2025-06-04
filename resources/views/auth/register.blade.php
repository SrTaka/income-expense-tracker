<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#1a1f2e]">
        <div class="w-full sm:max-w-md mt-6 px-6 bg-[#262b3c] shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-gray-200" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" class="text-green-500 font-medium text-sm tracking-wide" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" class="text-green-500 text-gray-100 font-medium text-sm tracking-wide" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" class="text-green-500 font-medium text-sm tracking-wide" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" class="text-green-500  font-medium text-sm tracking-wide" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-2 w-full text-gray-100 bg-[#1a1f2e] border-gray-600 focus:border-green-400 focus:ring-green-400 placeholder-gray-500"
                                type="password"
                                name="password_confirmation"
                                required 
                                autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300" />
                </div>
                <div class="flex items-center justify-end mt-6">
                    <a class="text-sm text-gray-300 hover:text-green-400 me-4 transition-colors duration-200" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="bg-green-600 hover:bg-green-500 text-white font-medium py-2 px-4 rounded transition-colors duration-200">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>