<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $userStats = [
            'total' => User::count(),
            'admin' => User::role('admin')->count(),
            'accountant' => User::role('accountant')->count(),
            'user' => User::role('user')->count(),
        ];

        return view('admin.reports.index', compact('userStats'));
    }
} 