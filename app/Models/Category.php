<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'admin_id'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function allChildrenHierarchy()
    {
       return $this->children()->with('allChildrenHierarchy');
    }

    public function parent()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
