<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    /**
     * Display the appropriate dashboard based on user role
     */
    public function index()
    {
        $user = auth()->user();
        $data = [];

        // Get monthly income/expense trends for the last 6 months
        $data['monthlyTrends'] = $this->getMonthlyTrends();

        // Get category-wise expenses for the current month
        $data['categoryExpenses'] = $this->getCategoryExpenses();

        // Get recent transactions
        $data['recentTransactions'] = $this->getRecentTransactions();

        // Get current month summary
        $data['monthlySummary'] = $this->getMonthlySummary();

        if($user->hasRole('admin')) {
            return view('admin.dashboard', $data);
        }
        
        if($user->hasRole('accountant')) {
            return view('accountant.dashboard', $data);
        }
        
        return view('user.dashboard', $data);
    }

    /**
     * Get monthly income/expense trends for the last 6 months
     */
    private function getMonthlyTrends()
    {
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        return Transaction::select(
            DB::raw('DATE_FORMAT(date, "%Y-%m") as month'),
            DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income'),
            DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expense')
        )
        ->whereBetween('date', [$startDate, $endDate])
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    }

    /**
     * Get category-wise expenses for the current month
     */
    private function getCategoryExpenses()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        return Category::select('categories.name', DB::raw('SUM(transactions.amount) as total'))
            ->join('transactions', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.type', 'expense')
            ->whereBetween('transactions.date', [$startDate, $endDate])
            ->groupBy('categories.name')
            ->orderBy('total', 'desc')
            ->get();
    }

    /**
     * Get recent transactions
     */
    private function getRecentTransactions()
    {
        return Transaction::with('category')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
    }

    /**
     * Get current month summary
     */
    private function getMonthlySummary()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        return Transaction::select(
            DB::raw('SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as total_income'),
            DB::raw('SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as total_expense')
        )
        ->whereBetween('date', [$startDate, $endDate])
        ->first();
    }
}