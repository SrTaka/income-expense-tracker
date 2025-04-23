<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'roles:admin,accountant,user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Protected admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users/{user}/roles', [UserController::class, 'editRoles']);
    Route::put('/admin/users/{user}/roles', [UserController::class, 'updateRoles']);
});

use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     // Admin-only routes
// });

// Route::middleware(['auth', 'permission:view-reports'])->group(function () {
//     // Report routes
// });

// Route::get('/roles', function () {
//     return Role::with('permissions')->get();
// })->middleware('auth');

require __DIR__.'/auth.php';
