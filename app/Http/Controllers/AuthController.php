<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        $data = User::create($validatedData);

        $token = $data->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'status_code' => 201,
            'message' => 'User Registered Successfully!',
            'data' => $data,
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $fieldType = filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $request->username_or_email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login Successful',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Logout Successful',
        ], 200);
    }
}
