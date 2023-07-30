<?php

namespace App\Http\Resources\Subject;

use App\Http\Resources\Phone\PhoneResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Telegram\TelegramResource;
use App\Http\Resources\Instagram\InstagramResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'phones'     => PhoneResource::collection($this->phones),
            'instagram'  => InstagramResource::make($this->instagram),
            'telegram'   => TelegramResource::make($this->telegram)
        ];
    }
}
