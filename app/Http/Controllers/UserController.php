<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of users with search and filtering.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Order by creation date (newest first)
        $users = $query->orderBy('created_at', 'desc')
            ->paginate(1)
            ->appends($request->query());

        // If it's an Ajax request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'users' => $users,
                'pagination' => (string) $users->links()
            ]);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente.',
            'user' => $user
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        $user->name = $validated['name'];
        $user->email = strtolower($validated['email']);

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente.',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(Request $request, User $user)
    {
        // Prevent deleting the currently authenticated user
        if ($user->id === $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar tu propio usuario.'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente.'
        ]);
    }
}
