<?php 

namespace App\Api\V1\AuthAdmin;

use App\Api\Base\Controller\ApiController;
use App\Api\V1\AuthAdmin\AuthAdminService;
use App\Api\V1\AuthAdmin\DTO\AdminLoginDTO;
use App\Api\V1\AuthAdmin\Requests\LoginAdminRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiAuthAdminController extends ApiController
{
    /**
     * Login admin
     * 
     * @group Auth Admin endpoints
     * 
     * @bodyParam email string required The email of the user. Example: example@example.com
     * @bodyParam password string required The password of the user. Example: password
     * @response status=200 scenario="success"{
     *    "data": {
     *      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjUwOWZlODQ3MzU1YTJkODM0YjU2NjQ2ZjIxMjAxZDBiZGQxMDc2Zjc0Y2Y1NTBiZGYyZjNmNTAxZDYyY2Q4NzI2YzcwMTQwMDVkZWU5ZWEiLCJpYXQiOjE2NTU5MjgzMzkuMzQwNDc0LCJuYmYiOjE2NTU5MjgzMzkuMzQwNDgsImV4cCI6MTY4NzQ2NDMzOS4zMDQzMjgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.kYOqYLIeiV61_FFGL7GMyUCl-7cwB6_AJvfNc8srN6GGzpIVDoEGMnWQINXPYIIBwQ0udpZI4Jb_1Rmal5u9x_IHJcswKTmDNX1BnXRp3MaEFoUouIc1g6qvMDSrm4WblgF6WDzE3OufdtxPIzrziKyvomnl3BSTjvpgqy-mIK-0wN3QUwXCB4GGjLTLc6rHyr52__mfM0qyCOAzx4ILv9iSXKH1KNK1hNIDf302KXE3JETJZ2CDifBJFiHGKxHbhPOXoQi-1bVmEKZD2l3wWlR68r2WLsohadW4rivAnQPKGWrTk9bjBkAh1Pz5P4D77RE4UpUgunomNoCWk0lkDbtyVxsgJaT_HC394yqggIYszFT0oy-0lmQPv6gpPfLsexn9Q2aabx2JZMarGCSthzXRSxcOcmNQZj1wRqcqK4IfW6VpUgMO1xteTx2Dpzw-k9PIAosUPwMeU7KlLTOKh9_XgTje7EsuUcmPS01kp6oLvfs06pLkwtlNAG2q37eycP3wLNY9M2H913XyVgNyT02bYczXbQHo6HK4HDmENDfhBIiwQ-O8f2Kg9tLF8aN-4a4RyZLyzFef0HeVYdEr08yuuDw654O8aGfpropy1wAvbk7LMOl75lNw7jdIESJLMn9o7kic-Pw2q9TipLP0Q-7R3DghEfU2FORdGVWgAPQ",
     *      "user": {
     *          "email": "example@gmail.com",
     *          "name": "example",
     *          "surname": "emample" 
     *      } 
     *    }
     * }
     * @response status=422 scenario="Unprocessable Entity"{
     *    "errors": {
     *      "login" : ["The email or password not correct."]
     *     }
     * }
     */
    public function login(LoginAdminRequest $loginAdminRequest, AuthAdminService $authAdminService): JsonResponse
    {
        try{
            return $this->success(
                $authAdminService->login(
                    new AdminLoginDTO(
                        $loginAdminRequest->email,
                        $loginAdminRequest->password
                    )
                )
            );
        } catch (ValidationException $e){
            return $this->validationErrors($e->errors());
        }
    }
}