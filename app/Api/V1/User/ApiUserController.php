<?php 

namespace App\Api\V1\User;

use App\Api\Base\Controller\ApiController;
use App\Api\V1\User\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class ApiUserController extends ApiController
{
    /**
     * Get logined user
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "email": "example@gmail.com",
     *       "nickname": "aut"
     *    } 
     * }
     * @response status=401 scenario="Unauthorized"{
     *    "message": "Unauthenticated." 
     * }
     * @authenticated
     * @response JsonResponse
     */
    public function profile(): JsonResponse
    {
        return $this->success(
            new UserResource(request()->user())
        );
    }
}