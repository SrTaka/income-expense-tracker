<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->hasRole('admin')) {
            return $this->adminDashboard();
        }
        
        return $this->userDashboard();
    }

    protected function adminDashboard()
    {
        // Get total users count
        $totalUsers = User::count();
        
        // Get total transactions amount
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpenses = Transaction::where('type', 'expense')->sum('amount');
        
        // Get recent transactions
        $recentTransactions = Transaction::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get monthly statistics
        $monthlyStats = Transaction::selectRaw('MONTH(created_at) as month, type, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month', 'type')
            ->get()
            ->groupBy('month');
            
        // Get category distribution
        $categoryStats = Transaction::select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->groupBy('category_id')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalIncome',
            'totalExpenses',
            'recentTransactions',
            'monthlyStats',
            'categoryStats'
        ));
    }

    protected function userDashboard()
    {
        $user = Auth::user();
        
        // Get user's transactions amount
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        // Calculate monthly amounts
        $monthlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        $monthlyExpenses = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        // Calculate balances
        $balance = $totalIncome - $totalExpense;
        $monthlyBalance = $monthlyIncome - $monthlyExpenses;
        
        // Get user's recent transactions
        $recentTransactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
            
        // Get user's monthly statistics
        $monthlyStats = Transaction::where('user_id', $user->id)
            ->selectRaw('MONTH(created_at) as month, type, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month', 'type')
            ->get()
            ->groupBy('month');
            
        // Get user's category distribution
        $categoryStats = Transaction::where('user_id', $user->id)
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->groupBy('category_id')
            ->get();

        return view('user.dashboard', compact(
            'totalIncome',
            'totalExpense',
            'monthlyIncome',
            'monthlyExpenses',
            'balance',
            'monthlyBalance',
            'recentTransactions',
            'monthlyStats',
            'categoryStats'
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
    public function deleteCategory(Category $category)
    {
        // Update associated transactions to have no category
        $category->transactions()->update(['category_id' => null]);

        // Now delete the category
        $category->delete();

        return redirect()->back()->with('success', 'Category and its associated transactions updated.');
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