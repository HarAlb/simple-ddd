<?php 

namespace App\Api\V1\Admin;

use App\Api\Base\Controller\ApiController;
use App\Api\V1\Admin\Resource\AdminResource;
use Illuminate\Http\JsonResponse;

class ApiAdminController extends ApiController
{
    /**
     * Get logined admin
     * 
     * @group Admin endpoints
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "email": "example@gmail.com",
     *       "name": "example",
     *       "surname": "example"
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
            new AdminResource(request()->user())
        );
    }
}