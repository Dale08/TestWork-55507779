<?php

declare(strict_types=1);

namespace App\Repositories\Book;

interface BookRepository
{
    public function all();

    public function findOrFail(int $id);

    public function search(string $search, ?string $order_by = null, ?string $order = 'ASC');
}
