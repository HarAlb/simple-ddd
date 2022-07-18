<?php 

namespace App\Api\V1\AuthAdmin;

use App\Api\Base\Contracts\InternalServiceContract;
use App\Api\V1\Admin\AdminService;
use App\Api\V1\AuthAdmin\Resource\AuthAdminResource;
use App\Api\V1\AuthAdmin\DTO\AdminLoginDTO;
use Illuminate\Support\Facades\Hash;

final class AuthAdminService extends InternalServiceContract
{
    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAdminService(): AdminService
    {
        return $this->adminService;
    }

    public function login(AdminLoginDTO $adminLoginDTO): AuthAdminResource
    {
        $admin = $this->getAdminService()->getAdminByEmail($adminLoginDTO->getEmail());
        if($admin)
        {
            if(Hash::check($adminLoginDTO->getPassword(), $admin->password))
            {
                return new AuthAdminResource($admin);
            }
        }

        $this->setValidationErrors(
            $this->createMessage('login', __('auth.admin_login'))
        );
    }
}