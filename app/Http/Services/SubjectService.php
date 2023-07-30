<?php

namespace App\Http\Services;

use App\Models\Subject;

class SubjectService
{
    public function store(array $data): Subject
    {
        $subject = Subject::create($data);
        $subject->phones()->createMany($data['phones']);

        if (isset($data['instagram'])) {
            $subject->instagram()->create(['account' => $data['instagram']]);
        }

        if (isset($data['telegram'])) {
            $subject->telegram()->create(['account' => $data['telegram']]);
        }

        return $subject->refresh();
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update($data);

        $subject->phones()->delete();
        $subject->phones()->createMany($data['phones']);

        $subject->instagram()->delete();
        if (isset($data['instagram'])) {
            $subject->instagram()->create(['account' => $data['instagram']]);
        }

        $subject->telegram()->delete();
        if (isset($data['telegram'])) {
            $subject->telegram()->create(['account' => $data['telegram']]);
        }

        return $subject->refresh();
    }
}