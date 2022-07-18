<?php 

declare(strict_types=1);

namespace App\Api\V1\AuthAdmin\DTO;

final class AdminLoginDTO
{
    /**
     * Login must be email
     */
    private string $email;

    /**
     * User password;
     */
    private string $password;

    public function __construct(
        string $email,
        string $password
    )
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}