<?php

namespace App\Api\V1\Category\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'children' => CategoryAdminResource::collection($this->whenLoaded('allChildrenHierarchy'))
        ];
    }
}
