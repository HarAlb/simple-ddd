<?php 

namespace App\Api\V1\Category;

use App\Api\Base\Contracts\InternalServiceContract;
use App\Api\Base\Contracts\SearchableInterface;
use App\Api\Base\Helpers\Helper;
use App\Api\V1\Category\DTO\CategoryDTO;
use App\Api\V1\Category\Repository\CategoryRepository;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

final class CategoryService extends InternalServiceContract
{
    private CategoryRepository $categoryRepository;

    public function __construct(?CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository ?? new CategoryRepository;
    }

    public function getCategoryRepository(): CategoryRepository
    {
        return $this->categoryRepository;
    }

    public function paginate(SearchableInterface $searchableInterface)
    {
        if ($searchableInterface->getSearch()) {
            $this->categoryRepository->search($searchableInterface);
        }

        return $this->categoryRepository->paginate();
    }

    public function store(CategoryDTO $categoryDTO): array
    {
        $slug = (new Helper())->generateSlug(
            $this->getCategoryRepository(),
            $categoryDTO->getName()
        );
        $categoryDTO->setSlug($slug);
        
        return $this->getCategoryRepository()->store($categoryDTO)->toArray();
    }

    public function update(CategoryDTO $categoryDTO): array
    {
        $category = $this->getCategory($categoryDTO->getId());
        $this->checkPermission($categoryDTO->getAdmin(), $category);
        if($categoryDTO->getName() === $category->name){
            $categoryDTO->setSlug($category->slug);
        }else{
            $slug = (new Helper())->generateSlug(
                $this->getCategoryRepository(),
                $categoryDTO->getName()
            );
            $categoryDTO->setSlug($slug);
        }
        
        $this->getCategoryRepository()->update($categoryDTO);

        return $this->getCategory($categoryDTO->getId())->toArray();
    }

    public function getCategory(int $id): ?Model
    {
        return $this->getCategoryRepository()->getCategoryById($id);
    }

    public function checkPermission(Admin $admin, ?Category $category = null): void
    {
        if(!$category){
            $this->setNotFoundError([
                'message' => 'Resource not found.'
            ]);
        }
        if($category->admin_id !== $admin->id)
        {
            $this->setAccessDeniedErrors([
                'message' => 'Permission denied.'
            ]);
        }
    }
}