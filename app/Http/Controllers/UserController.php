<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Menambahkan ukuran maksimal untuk avatar
        ]);
    
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars');
        }
    
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        return response()->json($user, 201);
    }
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);
    
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/' . $user->avatar))) {
                unlink(storage_path('app/' . $user->avatar));
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars');
        }
    
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }
    
        $user->update($validated);
        return response()->json($user, 200);
    }
    
    public function destroy(User $user)
    {
        if ($user->avatar && file_exists(storage_path('app/' . $user->avatar))) {
            unlink(storage_path('app/' . $user->avatar));
        }
    
        $user->delete();
        return response()->noContent();
    }
    
}
