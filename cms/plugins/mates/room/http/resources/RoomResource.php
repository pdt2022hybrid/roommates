<?php

namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
class RoomResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'room_count' => $this->resource->room_count,
            'room_owner_id' => $this->resource->room_owner_id,
            'room_url' => $this->resource->room_url,
        ];
    }
}
