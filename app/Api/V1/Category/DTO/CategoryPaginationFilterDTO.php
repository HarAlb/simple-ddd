<?php 

declare(strict_types=1);

namespace App\Api\V1\Category\DTO;

use App\Api\Base\Contracts\SearchableInterface;

final class CategoryPaginationFilterDTO implements SearchableInterface
{
    /**
     * Search string
     */
    private ?string $search;

    public function __construct(
        ?string $search = null
    ) {
        $this->search = $search;
    }

    public function getSearch(): ?string
    {
        return $this->search;   
    }
}