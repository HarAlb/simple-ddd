<?php

namespace App\Api\Base\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SlugableInterface
{
    public function getSimilarSlugs(string $slug): Collection;
}