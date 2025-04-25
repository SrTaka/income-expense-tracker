<div x-data="{ open: false }" 
     @click.away="open = false"
     class="fixed left-0 top-16 h-[calc(100%-4rem)] bg-gray-50 dark:bg-gray-900 shadow-lg z-50 transition-all duration-300"
     :class="open ? 'w-64' : 'w-16'">
    
    <!-- Toggle Button -->
    <button @click="open = !open" 
            class="w-full p-4 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'block': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': !open, 'block': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Navigation Items -->
    <div class="py-4">
        <!-- Add Income -->
        <button @click="$dispatch('open-modal', 'add-income')"
                class="w-full flex items-center p-4 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span x-show="open" class="ml-3">Add Income</span>
        </button>

        <!-- Add Expense -->
        <button @click="$dispatch('open-modal', 'add-expense')"
                class="w-full flex items-center p-4 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="open" class="ml-3">Add Expense</span>
        </button>

        <!-- Manage Categories -->
        <button @click="$dispatch('open-modal', 'manage-categories')"
                class="w-full flex items-center p-4 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span x-show="open" class="ml-3">Manage Categories</span>
        </button>

        <!-- Add Commission -->
        <button @click="$dispatch('open-modal', 'add-commission')"
                class="w-full flex items-center p-4 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="open" class="ml-3">Add Commission</span>
        </button>
    </div>
</div> 