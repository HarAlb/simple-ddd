<?php 

namespace App\Api\V1\Auth;

use App\Api\V1\Auth\Requests\LoginRequest;
use App\Api\Base\Controller\ApiController;
use App\Api\V1\Auth\DTO\AuthLoginDTO;
use App\Api\V1\Auth\DTO\AuthRegisterDTO;
use App\Api\V1\Auth\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends ApiController
{
    /**
     * Login user
     * 
     * @group Auth endpoints
     * 
     * @bodyParam login string required The login of the user. Example: dasadsa
     * @bodyParam password string required The password of the user. Example: hash132
     * @response status=200 scenario="success"{
     *    "data": {
     *      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjUwOWZlODQ3MzU1YTJkODM0YjU2NjQ2ZjIxMjAxZDBiZGQxMDc2Zjc0Y2Y1NTBiZGYyZjNmNTAxZDYyY2Q4NzI2YzcwMTQwMDVkZWU5ZWEiLCJpYXQiOjE2NTU5MjgzMzkuMzQwNDc0LCJuYmYiOjE2NTU5MjgzMzkuMzQwNDgsImV4cCI6MTY4NzQ2NDMzOS4zMDQzMjgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.kYOqYLIeiV61_FFGL7GMyUCl-7cwB6_AJvfNc8srN6GGzpIVDoEGMnWQINXPYIIBwQ0udpZI4Jb_1Rmal5u9x_IHJcswKTmDNX1BnXRp3MaEFoUouIc1g6qvMDSrm4WblgF6WDzE3OufdtxPIzrziKyvomnl3BSTjvpgqy-mIK-0wN3QUwXCB4GGjLTLc6rHyr52__mfM0qyCOAzx4ILv9iSXKH1KNK1hNIDf302KXE3JETJZ2CDifBJFiHGKxHbhPOXoQi-1bVmEKZD2l3wWlR68r2WLsohadW4rivAnQPKGWrTk9bjBkAh1Pz5P4D77RE4UpUgunomNoCWk0lkDbtyVxsgJaT_HC394yqggIYszFT0oy-0lmQPv6gpPfLsexn9Q2aabx2JZMarGCSthzXRSxcOcmNQZj1wRqcqK4IfW6VpUgMO1xteTx2Dpzw-k9PIAosUPwMeU7KlLTOKh9_XgTje7EsuUcmPS01kp6oLvfs06pLkwtlNAG2q37eycP3wLNY9M2H913XyVgNyT02bYczXbQHo6HK4HDmENDfhBIiwQ-O8f2Kg9tLF8aN-4a4RyZLyzFef0HeVYdEr08yuuDw654O8aGfpropy1wAvbk7LMOl75lNw7jdIESJLMn9o7kic-Pw2q9TipLP0Q-7R3DghEfU2FORdGVWgAPQ",
     *      "user": {
     *          "email": "example@gmail.com",
     *          "nickname": "example" 
     *      } 
     *    }
     * }
     * @response status=422 scenario="Unprocessable Entity"{
     *    "errors": {
     *      "login" : ["The login or password is incorect."]
     *     }
     * }
     */
    public function login(LoginRequest $loginRequest, AuthService $authService): JsonResponse
    {
        try{
            return $this->success(
                $authService->login(
                    new AuthLoginDTO(
                        $loginRequest->login,
                        $loginRequest->password
                    )
                )
            );
        } catch (ValidationException $exception) {
            return $this->validationErrors($exception->errors());
        }
    }
    
    /**
     * User register proccess
     * 
     * @group Auth endpoints
     * 
     * @bodyParam nickname string The login of the user. Example: haralb
     * @bodyParam email string required The email of the user. Example: example@gmail.com
     * @bodyParam password string required The password of the user. Example: password
     * @response status=200 scenario="success"{
     *    "data": {
     *      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjUwOWZlODQ3MzU1YTJkODM0YjU2NjQ2ZjIxMjAxZDBiZGQxMDc2Zjc0Y2Y1NTBiZGYyZjNmNTAxZDYyY2Q4NzI2YzcwMTQwMDVkZWU5ZWEiLCJpYXQiOjE2NTU5MjgzMzkuMzQwNDc0LCJuYmYiOjE2NTU5MjgzMzkuMzQwNDgsImV4cCI6MTY4NzQ2NDMzOS4zMDQzMjgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.kYOqYLIeiV61_FFGL7GMyUCl-7cwB6_AJvfNc8srN6GGzpIVDoEGMnWQINXPYIIBwQ0udpZI4Jb_1Rmal5u9x_IHJcswKTmDNX1BnXRp3MaEFoUouIc1g6qvMDSrm4WblgF6WDzE3OufdtxPIzrziKyvomnl3BSTjvpgqy-mIK-0wN3QUwXCB4GGjLTLc6rHyr52__mfM0qyCOAzx4ILv9iSXKH1KNK1hNIDf302KXE3JETJZ2CDifBJFiHGKxHbhPOXoQi-1bVmEKZD2l3wWlR68r2WLsohadW4rivAnQPKGWrTk9bjBkAh1Pz5P4D77RE4UpUgunomNoCWk0lkDbtyVxsgJaT_HC394yqggIYszFT0oy-0lmQPv6gpPfLsexn9Q2aabx2JZMarGCSthzXRSxcOcmNQZj1wRqcqK4IfW6VpUgMO1xteTx2Dpzw-k9PIAosUPwMeU7KlLTOKh9_XgTje7EsuUcmPS01kp6oLvfs06pLkwtlNAG2q37eycP3wLNY9M2H913XyVgNyT02bYczXbQHo6HK4HDmENDfhBIiwQ-O8f2Kg9tLF8aN-4a4RyZLyzFef0HeVYdEr08yuuDw654O8aGfpropy1wAvbk7LMOl75lNw7jdIESJLMn9o7kic-Pw2q9TipLP0Q-7R3DghEfU2FORdGVWgAPQ",
     *      "user": {
     *          "email": "example@gmail.com",
     *          "nickname": "example" 
     *      } 
     *    }
     * }
     * @response status=422 scenario="Unprocessable Entity"{
     *    "success": false,
     *    "errors": {
     *      "email": [
     *           "The email field is required."
     *      ],
     *      "nickname" : [
     *           "The login or password is incorect."
     *      ],
     *      "password": [
     *           "The password field is required." 
     *      ]
     *     }
     * }
     */
    public function register(RegisterRequest $registerRequest, AuthService $authService): JsonResponse
    {
        try{
            return $this->success(
                $authService->register(
                    new AuthRegisterDTO(
                        $registerRequest->email,
                        $registerRequest->password,
                        $registerRequest->nickname
                    )
                )
            );
        } catch (ValidationException $exception) {
            return $this->validationErrors($exception->errors());
        }
    }
}