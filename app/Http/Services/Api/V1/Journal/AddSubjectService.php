<?php

namespace App\Http\Services\Api\V1\Journal;

use App\Models\Subject;

trait AddSubjectService
{
    public function add(array $data): Subject
    {
        $subject = $this->addSubject($data);

        $subject->phones()->create([
            'phone' => $data['phone']
        ]);

        return $subject;
    }

    public function addSubject(array $data): Subject
    {
        $subject = new Subject();

        $subject->first_name = $data['first_name'];
        $subject->last_name = $data['last_name'] ?? null;

        $subject->save();

        return $subject;
    }
}