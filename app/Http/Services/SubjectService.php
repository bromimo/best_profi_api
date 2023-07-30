<?php

namespace App\Http\Services;

use App\Models\Subject;

class SubjectService
{
    public function store(array $data): Subject
    {
        $subject = Subject::create($data);
        $subject->phones()->createMany($data['phones']);

        return $subject->refresh();
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update($data);
        $subject->phones()->delete();
        $subject->phones()->createMany($data['phones']);

        return $subject->refresh();
    }
}