<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        if (!$token = Auth::guard('api')->attempt(
            $request->only('email', 'password')
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'type' => 'Bearer'
            ]
        ]);
    }

    public function refresh()
    {
    $newToken = Auth::guard('api')->refresh();

    return response()->json([
        'success' => true,
        'message' => 'Token berhasil diperbarui',
        'data' => [
            'token' => $newToken,
            'type'  => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]
    ]);
}

    public function logout()
    {
    Auth::guard('api')->logout();

    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil'
    ], 200);
    }
}