<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // Validate and update settings
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            // Add more settings as needed
        ]);

        // Save settings (implement your settings storage logic)

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
} 