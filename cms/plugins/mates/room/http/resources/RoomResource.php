<?php

namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mates\Room\Models\Miniroom;
use Mates\User\Http\Resources\UserResource;
class RoomResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'room_count' => $this->room_count,
            'room_identifier' => $this->room_identifier,
            'room_owner' => UserResource::make($this->room_owner),
        ];
    }
}
