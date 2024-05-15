<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            return response()->json('Login successful', 200);
        }
    
        return response()->json('The provided credentials do not match our records.', 401);
    }
    

    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json('Registration successful', 201);
    }

    public function logout() {
        Auth::logout();
        return response()->json('Logged out', 200);
    }
}
