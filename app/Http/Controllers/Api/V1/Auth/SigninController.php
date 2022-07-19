<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SigninRequest;
use App\Http\Services\Api\V1\Auth\SigninService;

class SigninController extends Controller
{
    use SigninService;

    public function __invoke(SigninRequest $request)
    {
        $data = $request->validated();

        return $this->signin($data);
    }
}
