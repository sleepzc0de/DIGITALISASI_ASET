<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

     public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
            'nip' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Create user
        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        // Prevent editing Super Admin by non-super admin
        if ($user->is_super_admin && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Anda tidak dapat mengedit Super Admin.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Prevent editing Super Admin by non-super admin
        if ($user->is_super_admin && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Anda tidak dapat mengedit Super Admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        // Prevent changing Super Admin role
        if ($user->is_super_admin) {
            $validated['role'] = 'admin';
            $validated['is_super_admin'] = true;
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting Super Admin
        if ($user->is_super_admin) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Super Admin tidak dapat dihapus!');
        }

        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
