<?php

namespace App\Http\Resources\Schedule;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => UserResource::make($this),
            'schedule' => $this->schedule->groupBy('day')->map(function ($items, $day) {
                return [
                    'day'  => Schedule::DAYS_RU[$day],
                    'time' => $items->pluck('time')->toArray()
                ];
            })->values()
        ];
    }
}
