<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Overview</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="text-sm text-blue-600">Total Users</div>
                <div class="text-2xl font-bold text-blue-800">{{ \App\Models\User::count() }}</div>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="text-sm text-green-600">Total Income</div>
                <div class="text-2xl font-bold text-green-800">$0</div>
            </div>
            <div class="bg-red-50 p-4 rounded-lg">
                <div class="text-sm text-red-600">Total Expenses</div>
                <div class="text-2xl font-bold text-red-800">$0</div>
            </div>
        </div>
    </div>
</div> 