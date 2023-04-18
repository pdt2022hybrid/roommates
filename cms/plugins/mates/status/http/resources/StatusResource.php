<?php

namespace Mates\Status\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
