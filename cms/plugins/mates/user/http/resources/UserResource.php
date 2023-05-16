<?php

namespace Mates\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "room_id" => $this->room_id,
            "name" => $this->name,
            "surname" => $this->surname,
            "email" => $this->email,
            "registered_at" => Carbon::parse($this->created_at)->format('d.m.Y'),
            "avatar" => optional($this->resource->avatar)->path,
        ];
    }
}
