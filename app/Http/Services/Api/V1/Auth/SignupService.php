<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Services\Api\V1\Journal\AddSubjectService;

trait SignupService
{
    use AddSubjectService;

    public function signup(array $data)
    {
        $subject = $this->addSubject($data);

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