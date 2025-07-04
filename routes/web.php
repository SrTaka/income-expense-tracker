<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Income routes
    Route::post('/income', [DashboardController::class, 'storeIncome'])->name('income.store');
    
    // Expense routes
    Route::post('/expense', [DashboardController::class, 'storeExpense'])->name('expense.store');
    
    // Category routes
    Route::post('/categories', [DashboardController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [DashboardController::class, 'deleteCategory'])->name('categories.destroy');
    
    // Commission routes
    Route::post('/commission', [DashboardController::class, 'storeCommission'])->name('commission.store');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes protected by admin role middleware
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Admin Dashboard (uses same controller)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        
        // Settings
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
        
        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        
        // Products
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        
        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    });
});

require __DIR__.'/auth.php';
