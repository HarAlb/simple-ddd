<?php

namespace App\Api\V1\AuthAdmin\Resource;

use App\Api\V1\Admin\Resource\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthAdminResource extends JsonResource
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
            'token' => $this->createToken('adminToken', ['admin'])->accessToken,
            'user' => new AdminResource($this)
        ];
    }
}
