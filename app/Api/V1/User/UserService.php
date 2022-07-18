<?php 

namespace App\Api\V1\User;

use App\Api\Base\Contracts\CreatableInterface;
use App\Api\Base\Contracts\InternalServiceContract;
use App\Api\V1\User\Repository\UserRepository;
use Illuminate\Database\Eloquent\Model;

final class UserService extends InternalServiceContract
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserRepository() : UserRepository
    {
        return $this->userRepository;
    }

    public function store(CreatableInterface $authRegisterDTO): ?Model
    {
        return $this->getUserRepository()->store($authRegisterDTO);
    }

    public function getUser(string $login): ?Model
    {
        $user = $this->getUserRepository()->getUserByEmail(
            $login
        );
        if (!$user) {
            $user = $this->getUserRepository()
                         ->getUserByNickName($login);
        }

        return $user;
    }
}