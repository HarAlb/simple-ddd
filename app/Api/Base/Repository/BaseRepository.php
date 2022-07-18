<?php 

namespace App\Api\Base\Repository;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function getFirst(Builder $builder): ?Model
    {
        return $builder->limit(1)->first();
    }
}