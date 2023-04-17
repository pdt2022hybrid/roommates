<?php

namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mates\Room\Http\resources\RoomResource;
class MiniRoomResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'room' => new RoomResource($this->room) //TODO: toto je picovina ma tam byt RoomResource::make($this->room)
        ];
    }
}
