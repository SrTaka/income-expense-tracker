<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    
    public function editRoles(User $user)
    {
        $roles = Role::all();
        return view('admin.users.roles', compact('user', 'roles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->syncRoles($request->roles); // Replace all roles
        // OR: $user->assignRole($request->roles); // Add new roles

        return redirect()->back()->with('success', 'Roles updated!');
    }
}


