<?php

namespace App\Api\Base\Contracts;

interface SearchableInterface
{
    public function getSearch(): ?string;
}
