@extends('layouts.admin')

@section('header', 'Edit User')

@section('content')
    <div class="max-w-2xl mx-auto">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="New Password (leave blank to keep current)" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Confirm New Password" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" value="Role" />
                <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <x-secondary-button onclick="window.history.back()" type="button" class="mr-3">
                    Cancel
                </x-secondary-button>
                <x-primary-button>
                    Update User
                </x-primary-button>
            </div>
        </form>

        <!-- User Activity -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">User Activity</h3>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($user->activities()->latest()->take(5)->get() as $activity)
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($activity->action) }}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $activity->details }}</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">No recent activity</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- User Statistics -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">User Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Total Transactions</div>
                    <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $user->transactions()->count() }}</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Last Login</div>
                    <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 