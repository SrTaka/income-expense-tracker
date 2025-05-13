<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class GeneralUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user role
        $userRole = Role::where('name', 'user')->first();

        if (!$userRole) {
            throw new \Exception('User role not found. Please run RoleSeeder first.');
        }

        // Create multiple general users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                    'email_verified_at' => now(),
                ]
            );

            // Assign user role
            $user->syncRoles([$userRole]);

            // Create sample transactions for each user
            $this->createSampleTransactions($user);
        }
    }

    /**
     * Create sample transactions for a user
     */
    private function createSampleTransactions(User $user): void
    {
        $categories = Category::all();
        $now = Carbon::now();

        // Create income transactions
        $incomeCategories = $categories->where('type', 'income');
        foreach ($incomeCategories as $category) {
            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'amount' => rand(1000, 5000),
                'type' => 'income',
                'description' => "Sample {$category->name} income",
                'date' => $now->copy()->subDays(rand(1, 30)),
            ]);
        }

        // Create expense transactions
        $expenseCategories = $categories->where('type', 'expense');
        foreach ($expenseCategories as $category) {
            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'amount' => rand(50, 500),
                'type' => 'expense',
                'description' => "Sample {$category->name} expense",
                'date' => $now->copy()->subDays(rand(1, 30)),
            ]);
        }

        // Get or create commission category
        $commissionCategory = Category::firstOrCreate(
            ['name' => 'Commission', 'type' => 'income'],
            [
                'name' => 'Commission',
                'type' => 'income',
                'color' => '#4CAF50'
            ]
        );

        // Create commission transactions as income type
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $commissionCategory->id,
            'amount' => rand(100, 1000),
            'type' => 'income',
            'description' => 'Sample commission income',
            'date' => $now->copy()->subDays(rand(1, 30)),
        ]);
    }
} 