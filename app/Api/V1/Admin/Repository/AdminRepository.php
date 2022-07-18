<?php 

namespace App\Api\V1\Admin\Repository;

use App\Api\Base\Repository\BaseRepository;
use App\Models\Admin;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AdminRepository extends BaseRepository
{
    private Builder $adminModel;

    public function getAdminModel()
    {
        return $this->adminModel ?? Admin::query();
    }

    public function getAdminByEmail(string $email): ?Model
    {
        return $this->getFirst(
                    $this->getAdminModel()
                         ->where('email', $email)
                );
    }
}