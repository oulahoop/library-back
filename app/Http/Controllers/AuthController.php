<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'profile_picture_path' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $token = $user->createToken('auth_token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($data)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();

        return response(['message' => 'Successfully logged out']);
    }
}
