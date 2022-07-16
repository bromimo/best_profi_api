<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Auth\SignupService;
use App\Http\Requests\Api\V1\Auth\SignupRequest;

class SignupController extends Controller
{
    use SignupService;

    public function __invoke(SignupRequest $request)
    {
        $data = $request->validated();

        $this->signup($data);

        return '111';
    }
}
