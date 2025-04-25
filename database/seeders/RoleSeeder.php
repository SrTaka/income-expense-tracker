<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard permissions
            'view-dashboard',
            
            // User management
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',
            'manage-user-roles',
            
            // Transaction management
            'create-transactions',
            'edit-transactions',
            'delete-transactions',
            'view-transactions',
            'manage-transactions',
            
            // Category management
            'create-categories',
            'edit-categories',
            'delete-categories',
            'view-categories',
            'manage-categories',
            
            // Report management
            'view-reports',
            'generate-reports',
            'export-reports',
            
            // Settings management
            'manage-settings',
            'view-settings',
            
            // Commission management
            'manage-commission',
            'view-commission'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // Assign all permissions to admin role
        $adminRole->givePermissionTo($permissions);
        
        // Assign specific permissions to user role
        $userRole->givePermissionTo([
            'view-dashboard',
            'create-transactions',
            'edit-transactions',
            'delete-transactions',
            'view-transactions',
            'view-categories',
            'view-reports',
            'manage-commission'
        ]);
    }
}




