<?php

namespace Modules\Mission\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Image\Http\Resources\ImageResource;

class MissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'content' => $this->resource->content,
            'location' => $this->resource->location,
            'language' => $this->resource->language,
            'duration' => $this->resource->duration,
            'start' => $this->resource->start,
            'user_id'=> $this->resource->user_id,
            'images' => ImageResource::collection($this->resource->images),
        ];
    }
}
