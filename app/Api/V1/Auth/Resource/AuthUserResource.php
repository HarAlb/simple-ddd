<?php

namespace App\Api\V1\Auth\Resource;

use App\Api\V1\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'token' => $this->createToken('Token Name', ['user'])->accessToken,
            'user' => new UserResource($this)
        ];
    }
}
