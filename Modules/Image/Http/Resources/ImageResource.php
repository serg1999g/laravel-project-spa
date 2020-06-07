<?php

namespace Modules\Image\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'imageable_id' => $this->resource->imageable_id,
            'image' => url('/storage/' . $this->resource->image),
        ];
    }
}
