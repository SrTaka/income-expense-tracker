<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    /**
     * Display the appropriate dashboard based on user role
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')) {
            return view('admin.dashboard');
        }
        
        if(auth()->user()->hasRole('accountant')) {
            return view('accountant.dashboard');
        }
        
        return view('user.dashboard');
    }
}