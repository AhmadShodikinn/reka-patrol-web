<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;

class ApiAuthController extends Controller
{
    public function login(ApiLoginRequest $request) {
        if (auth()->attempt($request->only('nip', 'password'))) {
            return response()->json([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('token')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'failed',
        ], 401);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out',
        ]);
    }
}
