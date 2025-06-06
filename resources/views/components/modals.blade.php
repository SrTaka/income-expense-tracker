<!-- Add Income Modal -->
<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === 'add-income') show = true"
     x-on:close-modal.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="POST" action="{{ route('income.store') }}" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="amount">
                        Amount
                    </label>
                    <input type="number" step="0.01" name="amount" id="amount" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="category">
                        Category
                    </label>
                    <select name="category_id" id="category" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Category</option>
                        @foreach($incomeCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea name="description" id="description"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="show = false"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Income
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === 'add-expense') show = true"
     x-on:close-modal.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="POST" action="{{ route('expense.store') }}" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="amount">
                        Amount
                    </label>
                    <input type="number" step="0.01" name="amount" id="amount" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="category">
                        Category
                    </label>
                    <select name="category_id" id="category" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Category</option>
                        @foreach($expenseCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea name="description" id="description"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="show = false"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Categories Modal -->
<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === 'manage-categories') show = true"
     x-on:close-modal.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Manage Categories</h3>
                
                <!-- Income Categories -->
                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Income Categories</h4>
                    <form method="POST" action="{{ route('categories.store') }}" class="mb-4">
                        @csrf
                        <input type="hidden" name="type" value="income">
                        <div class="flex">
                            <input type="text" name="name" placeholder="New category name"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Add
                            </button>
                        </div>
                    </form>
                    <div class="space-y-2">
                        @foreach($incomeCategories as $category)
                            <div class="flex items-center justify-between">
                                <span>{{ $category->name }}</span>
                                <button @click="$dispatch('delete-category', {{ $category->id }})"
                                        class="text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Expense Categories -->
                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Expense Categories</h4>
                    <form method="POST" action="{{ route('categories.store') }}" class="mb-4">
                        @csrf
                        <input type="hidden" name="type" value="expense">
                        <div class="flex">
                            <input type="text" name="name" placeholder="New category name"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Add
                            </button>
                        </div>
                    </form>
                    <div class="space-y-2">
                        @foreach($expenseCategories as $category)
                            <div class="flex items-center justify-between">
                                <span>{{ $category->name }}</span>
                                <button @click="$dispatch('delete-category', {{ $category->id }})"
                                        class="text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button @click="show = false"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Commission Modal -->
<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === 'add-commission') show = true"
     x-on:close-modal.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="POST" action="{{ route('commission.store') }}" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="type">
                        Type
                    </label>
                    <select name="type" id="type" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="income">Income Commission</option>
                        <option value="expense">Expense Commission</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="amount">
                        Amount
                    </label>
                    <input type="number" step="0.01" name="amount" id="amount" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="percentage">
                        Percentage
                    </label>
                    <input type="number" step="0.01" name="percentage" id="percentage" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea name="description" id="description"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="show = false"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Commission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('delete-category', (event) => {
        if (confirm('Are you sure you want to delete this category?')) {
            const categoryId = event.detail;
            axios.delete(`/categories/${categoryId}`)
                .then(response => {
                    console.log(response.data.message);
                    // Refresh the page or remove the category from the UI
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error deleting category:', error);
                    alert('Failed to delete category.');
                });
        }
    });
</script>
@endpush 