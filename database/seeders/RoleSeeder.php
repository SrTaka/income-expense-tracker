<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $accountant = Role::create(['name' => 'accountant']);
        
        // Create permissions (optional)
        $permissions = [
            'create-income',
            'edit-income',
            'delete-income',
            'create-expense',
            'edit-expense',
            'delete-expense',
            'view-reports'
        ];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $accountant->givePermissionTo(['create-income', 'create-expense', 'view-reports']);
        $user->givePermissionTo(['view-reports']);
    }
    
}




