<?php

namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
class MiniRoomResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
