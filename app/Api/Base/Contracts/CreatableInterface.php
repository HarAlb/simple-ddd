<?php

namespace App\Api\Base\Contracts;

interface CreatableInterface
{
    public function toArrayForCreate(): array;
}
