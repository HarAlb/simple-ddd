<?php

namespace App\Api\Base\Contracts;

interface UpdateableInterface 
{
    public function toArrayForUpdate(): array;

    public function getId(): int;
}