<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $permissions = [
            'view-dashboard',
            'manage-users',
            'manage-categories',
            'manage-transactions',
            'view-reports',
            'manage-settings'
        ];

        $userPermissions = [
            'view-dashboard',
            'manage-transactions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $adminRole->syncPermissions($permissions);
        
        // Assign basic permissions to user role
        $userRole->syncPermissions($userPermissions);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Create test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Assign roles
        $admin->assignRole($adminRole);
        $user->assignRole($userRole);

        // Create some default categories
        $incomeCategories = [
            'Salary',
            'Freelance',
            'Investments',
            'Commission',
            'Other Income'
        ];

        $expenseCategories = [
            'Housing',
            'Food',
            'Transportation',
            'Utilities',
            'Entertainment',
            'Healthcare',
            'Education',
            'Other Expenses'
        ];

        foreach ($incomeCategories as $category) {
            \App\Models\Category::create([
                'name' => $category,
                'type' => 'income'
            ]);
        }

        foreach ($expenseCategories as $category) {
            \App\Models\Category::create([
                'name' => $category,
                'type' => 'expense'
            ]);
        }
    }
}



