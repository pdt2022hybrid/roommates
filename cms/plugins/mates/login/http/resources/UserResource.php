<?php

namespace Mates\Login\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    public function toArray($request) {
        return [
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            "surname" => $this->resource->surname,
            "email" => $this->resource->email,
            "is_activated" => $this->resource->is_activated,
            //"registered_at" => date($this->resource->created_at) //TODO: pouzi Carbon
            "registered_at" => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i:s'),
            
        ];
    }
}
