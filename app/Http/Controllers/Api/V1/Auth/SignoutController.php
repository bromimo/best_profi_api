<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SignoutController extends Controller
{
    public function __invoke()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'You have succesfully logged out and token was deleted.']);
    }
}
