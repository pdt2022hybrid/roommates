<?php namespace Mates\Room\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request) {
        return [

            'user_assigned_id' => $this->resource->user_assigned_id,
            'user_created_id' => $this->resource->user->id,
            'miniroom_id' => $this->resource->miniroom_id,
            'status_id' => $this->resource->status_id,
            'task_name' => $this->resource->task_name,
            'task_description' => $this->resource->task_description,
            'deadline' => $this->resource->deadline,

        ];
    }
}