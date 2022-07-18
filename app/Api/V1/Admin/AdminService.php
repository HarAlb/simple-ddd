<?php 

namespace App\Api\V1\Admin;

use App\Api\Base\Contracts\InternalServiceContract;
use App\Api\V1\Admin\Repository\AdminRepository;
use Illuminate\Database\Eloquent\Model;

final class AdminService extends InternalServiceContract
{
    private AdminRepository $adminRepository;

    public function __construct(?AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository ?? new AdminRepository;
    }

    public function getAdminByEmail(string $email): ?Model
    {
        return $this->adminRepository->getAdminByEmail($email);
    }
}