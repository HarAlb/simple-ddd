<?php 

declare(strict_types=1);

namespace App\Api\V1\Auth\DTO;

use App\Api\Base\Contracts\CreatableInterface;

final class AuthRegisterDTO implements CreatableInterface
{
    /**
     * User nickname.
     */
    private ?string $nickname;

    /**
     * User email.
     */
    private string $email;

    /**
     * User password;
     */
    private string $password;

    public function __construct(
        string $email,
        string $password,
        ?string $nickname = null
    )
    {
        $this->email = $email;
        $this->nickname = $nickname;
        $this->password = $password;
    }

    public function toArrayForCreate(): array
    {
        return [
            'email' => $this->email,
            'nickname' => $this->nickname,
            'password' => $this->password
        ];
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}