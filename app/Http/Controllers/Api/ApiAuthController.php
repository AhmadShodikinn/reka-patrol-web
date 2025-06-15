<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Requests\Auth\ApiResetPasswordRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(ApiLoginRequest $request) {
        if (auth()->attempt($request->only('nip', 'password'))) {
            return response()->json([
                'user' => UserResource::make(auth()->user()->load($request['relations'] ?? [])),
                'token' => auth()->user()->createToken('token')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'failed',
        ], 401);
    }

    
    public function resetPassword(ApiResetPasswordRequest $request)
    {
        $user = User::where('nip', $request->nip)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil direset. Silakan login dengan password baru.',
            'user' => new UserResource($user->load('position')),
        ]);
    }


    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out',
        ]);
    }
}
