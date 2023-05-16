<?php

namespace Mates\Task\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mates\User\Http\Resources\UserResource;
use Mates\Room\Http\resources\MiniRoomResource;
use Mates\Status\Http\Resources\StatusResource;

class TaskResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'miniroom' => new MiniRoomResource($this->miniroom),
            'status_id' => $this->status_id,
            'status' => new StatusResource($this->status),
            'user_created' => new UserResource($this->user),
            'user_assigned' => new UserResource($this->user_assigned)
        ];
    }
}
