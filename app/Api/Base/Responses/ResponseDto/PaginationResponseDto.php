<?php

namespace App\Api\Base\Responses\ResponseDto;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginationResponseDto
{
    public int $total;
    public $items;
    public int $last_page;
    public int $current_page;
    public int $per_page;

    public function __construct(LengthAwarePaginator $pagination, ?string $classNameResource = null)
    {
        $this->total = $pagination->total();
        $this->last_page = $pagination->lastPage();
        $this->items = $classNameResource ? call_user_func($classNameResource. '::collection', $pagination->items()) : new AnonymousResourceCollection($pagination->items());
        $this->current_page = $pagination->currentPage();
        $this->per_page = $pagination->perPage();
    }
}
