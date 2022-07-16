<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SignupRequest;

class SignupController extends Controller
{
    public function __invoke(SignupRequest $request)
    {
        return '111';
    }
}
