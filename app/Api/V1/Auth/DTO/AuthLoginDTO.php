<?php 

declare(strict_types=1);

namespace App\Api\V1\Auth\DTO;

final class AuthLoginDTO
{
    /**
     * Login must be email or nickname
     */
    private string $login;

    /**
     * User password;
     */
    private string $password;

    public function __construct(
        string $login,
        string $password
    )
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }
}