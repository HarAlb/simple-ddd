<?php 

namespace App\Api\V1\User\Repository;

use App\Api\Base\Contracts\CreatableInterface;
use App\Api\Base\Repository\BaseRepository;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    private Builder $userModel;

    public function getUserModel()
    {
        return $this->userModel ?? User::query();
    }

    public function getUserByEmail(string $email): ?Model
    {
        return $this->getFirst(
                    $this->getUserModel()
                         ->where('email', $email)
                );
    }

    public function getUserByNickName(string $nick_name): ?Model
    {
        return $this->getFirst(
                    $this->getUserModel()
                        ->where('nickname', $nick_name)
                );
    }

    public function store(CreatableInterface $auth_register_DTO): ?Model
    {
        return $this->getUserModel()->create($auth_register_DTO->toArrayForCreate());
    }
}