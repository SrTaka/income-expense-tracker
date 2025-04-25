<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Share categories with all views
        $incomeCategories = Category::where('type', 'income')->get();
        $expenseCategories = Category::where('type', 'expense')->get();
        
        View::share('incomeCategories', $incomeCategories);
        View::share('expenseCategories', $expenseCategories);
    }

    /**
     * Display the appropriate dashboard based on user role
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get total income and expenses
        $totalIncome = Transaction::where('type', 'income')
            ->where('user_id', $user->id)
            ->sum('amount');
            
        $totalExpenses = Transaction::where('type', 'expense')
            ->where('user_id', $user->id)
            ->sum('amount');
        
        // Get monthly income and expenses
        $monthlyIncome = Transaction::where('type', 'income')
            ->where('user_id', $user->id)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
            
        $monthlyExpenses = Transaction::where('type', 'expense')
            ->where('user_id', $user->id)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
        
        // Calculate balances
        $balance = $totalIncome - $totalExpenses;
        $monthlyBalance = $monthlyIncome - $monthlyExpenses;
        
        // Get recent transactions
        $recentTransactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->latest('date')
            ->take(10)
            ->get();
        
        return view('user.dashboard', compact(
            'totalIncome',
            'totalExpenses',
            'monthlyIncome',
            'monthlyExpenses',
            'balance',
            'monthlyBalance',
            'recentTransactions'
        ));
    }

    public function storeIncome(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        
        Transaction::create([
            'user_id' => auth()->id(),
            'type' => 'income',
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Income added successfully.');
    }
    
    public function storeExpense(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        
        Transaction::create([
            'user_id' => auth()->id(),
            'type' => 'expense',
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Expense added successfully.');
    }
    
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);
        
        Category::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);
        
        return redirect()->back()->with('success', 'Category added successfully.');
    }
    
    public function storeCommission(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string|max:255',
        ]);
        
        // Calculate commission amount
        $commissionAmount = ($request->amount * $request->percentage) / 100;
        
        Transaction::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'amount' => $commissionAmount,
            'category_id' => Category::where('name', 'Commission')->first()->id,
            'description' => $request->description,
            'date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Commission added successfully.');
    }
}