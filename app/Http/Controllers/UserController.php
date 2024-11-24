<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function profile()
    {
        return response()->json(auth()->user());
    }

    public function updateProfile()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'profile_picture_path' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = auth()->user();
        $user->update($data);

        return response($user);
    }

    public function updateProfilePicture()
    {
        $data = request()->validate([
            'profile_picture_path' => 'required|string',
        ]);

        $user = auth()->user();
        $user->update($data);

        return response($user);
    }
}
