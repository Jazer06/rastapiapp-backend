<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    // Регистрация
    public function register(Request $request)
    {   

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return response()->json([
            'message' => 'Пользователь успешно зарегистрирован',
            'user' => $user
        ], 201);
    }

    // Вход
    public function login(Request $request)
    {   

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Неверный email или пароль'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'user'          => $user->load('role')
        ]);
    }

    // Выход
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Вы вышли из системы']);
    }
}
