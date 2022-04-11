<?php

declare(strict_types=1);

namespace App\Repositories\Category;

interface CategoryRepository
{
    public function all();

    public function findOrFail(int $id);

    public function findBySlug(string $slug);
}
