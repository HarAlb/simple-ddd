<?php 

namespace App\Api\V1\Category\Repository;

use App\Api\Base\Contracts\CreatableInterface;
use App\Api\Base\Contracts\SearchableInterface;
use App\Api\Base\Contracts\SlugableInterface;
use App\Api\Base\Contracts\UpdateableInterface;
use App\Api\Base\Repository\BaseRepository;
use App\Models\Category;
use App\Api\V1\Category\Enum\CategoryEnum;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements SlugableInterface
{
    private Builder $categoryModel;

    public function getCategoryModel()
    {
        return $this->categoryModel ?? Category::query();
    }

    public function search(SearchableInterface $searchableInterface): self
    {
        foreach(CategoryEnum::SEARCHABLE_INPUTS as $field){
            $this->categoryModel = $this->getCategoryModel()
                   ->where($field, 'ilike', '%' . $searchableInterface->getSearch(). '%');
        }

        return $this;
    }

    public function paginate()
    {
        return $this->getCategoryModel()->whereNull('parent_id')->with('allChildrenHierarchy')->paginate();
    }

    public function store(CreatableInterface $creatableInterface): Model
    {
        return Category::create($creatableInterface->toArrayForCreate());
    }

    public function update(UpdateableInterface $updateableInterface): void
    {
        Category::where('id', $updateableInterface->getId())->update(
            $updateableInterface->toArrayForUpdate()
        );
    }

    public function getSimilarSlugs(string $slug, ?int $id = null): Collection
    {
        return $this->getCategoryModel()
                    ->where('id', '<>', $id)
                    ->where('slug', 'like', $slug . '%')->select([
                        'slug',
                        'id'
                    ])->get();
    }

    public function getCategoryById(int $id): ?Model
    {
        return $this->getFirst(
            $this->getCategoryModel()->where('id', $id)
        );
    }
}