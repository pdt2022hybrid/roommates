<?php

namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mates\User\Http\Resources\UserResource;
class RoomResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'room_count' => $this->resource->room_count,
            'room_url' => $this->resource->room_url,
            'room_owner' => new UserResource($this->resource->room_owner)
        ];
    }
}
