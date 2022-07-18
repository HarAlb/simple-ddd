<?php

namespace App\Api\Base\Contracts;

use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

abstract class InternalServiceContract
{
    private array $accessDeniedErrors;
    private array $notFoundMessageError;

    /**
     * @throws ValidationException
     */
    public function setValidationErrors(array $array)
    {
        throw ValidationException::withMessages($array);
    }

    /**
     * @throws AccessDeniedException
     */
    public function setAccessDeniedErrors(array $array)
    {
        $this->accessDeniedErrors = $array;
        throw new AccessDeniedException();
    }

     /**
     * @return array
     */
    public function getAccessDeniedErrors(): array
    {
        return $this->accessDeniedErrors;
    }

    /**
     * @throws NotFoundResourceException
     */
    public function setNotFoundError(array $array)
    {
        $this->notFoundMessageError = $array;
        throw new NotFoundResourceException();
    }

    /**
     * @return array
     */
    public function getNotFoundError(): array
    {
        return $this->notFoundMessageError;
    }

    /**
     * @param string $name
     * @param string ...$values
     * @return string[][]
     */
    public function createMessage(string $name, string ...$values): array
    {
        return [
            $name => $values
        ];
    }

    /**
     * @param string $name
     * @param string $message
     * @return string
     */
    public function createSimpleMessage(string $name, string $message): array
    {
        return [
            $name => $message
        ];
    }
}
