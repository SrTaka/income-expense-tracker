<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'site_name' => 'sometimes|string|max:255',
            'site_description' => 'sometimes|string|max:1000',
            'contact_email' => 'sometimes|email',
            'items_per_page' => 'sometimes|integer|min:5|max:100',
            // Add more validation rules as needed
        ]);

        // Update settings
        foreach ($validated as $key => $value) {
            setting([$key => $value]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
} 