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
            'task_name' => $this->resource->name,
            'task_description' => $this->resource->description,
            'deadline' => $this->resource->deadline,
            'miniroom' => new MiniRoomResource($this->resource->miniroom),
            'status_id' => $this->resource->status_id,
            'status' => new StatusResource($this->resource->status),
            'user_created' => new UserResource($this->resource->user),
            'user_assigned' => new UserResource($this->resource->user_assigned)
        ];
    }
}
