<?php 

declare(strict_types=1);

namespace App\Api\V1\Category\DTO;

use App\Api\Base\Contracts\CreatableInterface;
use App\Api\Base\Contracts\UpdateableInterface;
use App\Models\Admin;

final class CategoryDTO implements CreatableInterface, UpdateableInterface
{
    /**
     * Category name
     */
    private string $name;

    /**
     * Category slug
     */
    private string $slug;

    /**
     * Category author 
     */
    private Admin $admin;

    /**
     * Category parent id if exists.
     */
    private ?int $parentId;
    
    /**
     * Category id used for update
     */
    private ?int $id;

    public function __construct(
        string $name,
        Admin $admin,
        ?int $parentId = null,
        ?int $id = null
    ) {
        $this->name = $name;
        $this->admin = $admin;
        $this->parentId = $parentId;
        $this->id = $id;
    }

    public function toArrayForCreate(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parentId,
            'admin_id' => $this->admin->id
        ];
    }

    public function toArrayForUpdate(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parentId,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;   
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;   

        return $this;
    }

    public function getAdmin(): Admin
    {
        return $this->admin;   
    }
}