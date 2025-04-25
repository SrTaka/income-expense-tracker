@props([
    'title',
    'value',
    'type' => 'default', // default, success, danger
    'icon' => null
])

@php
$colorClasses = [
    'default' => 'text-gray-900 dark:text-gray-100',
    'success' => 'text-green-600 dark:text-green-400',
    'danger' => 'text-red-600 dark:text-red-400'
];
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $title }}</div>
                <div class="text-3xl font-bold {{ $colorClasses[$type] }}">
                    {{ $value }}
                </div>
            </div>
            @if($icon)
            <div class="text-2xl {{ $colorClasses[$type] }}">
                <i class="fas fa-{{ $icon }}"></i>
            </div>
            @endif
        </div>
        @if($slot->isNotEmpty())
        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            {{ $slot }}
        </div>
        @endif
    </div>
</div> 