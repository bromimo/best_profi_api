<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\QueryException;
use App\Exceptions\ScheduleStoreException;

class ScheduleService
{
    public function store(array $data, User $user): void
    {
        foreach ($data['schedule'] as $item) {
            $day = $item['day'];
            foreach ($item['time'] as $time) {
                try {
                    Schedule::create([
                        'user_id' => $user->id,
                        'day'     => $day,
                        'time'    => $time
                    ]);
                } catch (QueryException $e) {
                    throw new ScheduleStoreException('', 0, $e);
                }
            }
        }
    }

    public function update(array $data, User $user): void
    {
        $this->destroy($user);
        $this->store($data, $user);
    }

    public function destroy(User $user): void
    {
        Schedule::users($user->id)->delete();
    }
}