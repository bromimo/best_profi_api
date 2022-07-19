<?php

namespace App\Http\Services\Api\V1\Auth;

use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

trait SigninService
{
    public function signin(array $data)
    {
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken(Str::random(40))->plainTextToken;

        return response()->json([
            'data' => [
                'user'       => new UserResource($user),
                'token'      => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}