<?php

namespace App\Api\Base\Responses;

use App\Api\Base\Responses\ResponseDto\PaginationResponseDto;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationResponse
{
    public function paginationData (LengthAwarePaginator $pagination, ?string $classNameResource = null): PaginationResponseDto 
    {
        return new PaginationResponseDto($pagination, $classNameResource);
    }
}