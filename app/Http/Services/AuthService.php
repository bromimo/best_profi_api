<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Str;

trait AuthService
{
    public function response($user)
    {
        /** @var User $user */
        $user->tokens()->delete();
        $token = $user->createToken(Str::random(40))->plainTextToken;

        return response()->json([
            'data' => [
                'user'       => $user,
                'token'      => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}