<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Resources\User\UserResource;

class AuthController extends Controller
{
    use AuthService;

    public function signIn(SigninRequest $request)
    {
        $data = $request->validated();
        $user = User::withPhone($data['phone'])->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Пользователь не найден.'], 401);
        }

        if (!Auth::attempt(['id' => $user->id, 'password' => $data['password']])) {
            return response()->json(['message' => 'Не верный пароль.'], 401);
        }

        return $this->response(UserResource::make(Auth::user()));
    }

    public function signout()
    {
        Auth::user()->tokens()->delete();
    }
}
