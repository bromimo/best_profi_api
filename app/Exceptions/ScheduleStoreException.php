<?php

namespace App\Exceptions;

use Exception;
use App\Models\Schedule;
use Illuminate\Database\QueryException;

class ScheduleStoreException extends Exception
{
    public function render()
    {
        /** @var QueryException $e */
        $e = $this->getPrevious();
        $bind = $e->getBindings();
        $day = Schedule::DAYS_RU[$bind[1]];
        $time = $bind[2];

        return response()->json([
            'error' => 'Такая запись: ' . quotes($day . ' ' . $time) . ' уже существует.'
        ]);
    }
}
