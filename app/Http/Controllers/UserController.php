<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return User::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while fetching users'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating a user'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            return $user;
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while fetching the user'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the user'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the user'], 500);
        }
    }
}
