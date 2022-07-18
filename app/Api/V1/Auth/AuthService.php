<?php 

namespace App\Api\V1\Auth;

use App\Api\Base\Contracts\InternalServiceContract;
use App\Api\V1\Auth\DTO\AuthLoginDTO;
use App\Api\V1\Auth\DTO\AuthRegisterDTO;
use App\Api\V1\Auth\Resource\AuthUserResource;
use App\Api\V1\User\UserService;
use Illuminate\Support\Facades\Hash;

final class AuthService extends InternalServiceContract
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserService() : UserService
    {
        return $this->userService;
    }

    public function login(AuthLoginDTO $authLoginDTO): AuthUserResource
    {
        if($user = $this->getUserService()->getUser($authLoginDTO->getLogin())){
            return new AuthUserResource($user);
        }

        $this->setValidationErrors(
            $this->createMessage('login', __('auth.login'))
        ); 
    }

    public function register(AuthRegisterDTO $auth_register_DTO): AuthUserResource
    {
        $auth_register_DTO->setPassword(Hash::make($auth_register_DTO->getPassword()));
        
        return new AuthUserResource($this->getUserService()->store($auth_register_DTO));
    }
}

