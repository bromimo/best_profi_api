<?php

namespace App\Http\Controllers\Api\V1\Journal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Journal\AddSubjectRequest;
use App\Http\Services\Api\V1\Journal\AddSubjectService;

class AddSubjectController extends Controller
{
    use AddSubjectService;

    public function __invoke(AddSubjectRequest $request)
    {
        $data = $request->validated();

        $subject = $this->add($data);

        return $subject;
    }
}
