<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

trait SignupService
{
    public function signup(array $data)
    {
        $subject = new Subject();

        $subject->first_name = $data['first_name'];
        $subject->last_name = $data['last_name'] ?? null;

        $subject->save();

        $user = new User();

        $user->subject_id = $subject->id;
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

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