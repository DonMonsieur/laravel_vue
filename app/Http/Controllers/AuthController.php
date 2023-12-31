<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
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

        if (!Auth::attempt($credentials, $request->input('remember'))) {
            return response([
                'message' => 'Username/Email or password is incorrect'
            ], 401);
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $token = $user->createToken('myapptoken')->plainTextToken;

        // dd($token);

        if (!$token) {
            return response([
                'message' => 'No token found for the user'
            ], 500);
        }

        return response([
            'message' => 'Login Successful',
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Logged out successfully'
        ], 204);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        return new UserResource($user);
    }

    public function countUser()
    {
        $data = User::countUsers();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $data
        ], 200);
    }
}
