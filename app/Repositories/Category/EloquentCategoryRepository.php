<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Models\Category;

class EloquentCategoryRepository implements CategoryRepository
{
    public function __construct(private Category $model)
    {
    }

    public function all()
    {
        return $this->model::all();
    }

    public function findOrFail(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function findBySlug(string $slug)
    {
        return $this->model::whereSlug($slug)->first();
    }
}
