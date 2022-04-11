<?php

declare(strict_types=1);

namespace App\Repositories\Book;

use App\Models\Book;

class EloquentBookRepository implements BookRepository
{
    public function __construct(private Book $model)
    {
    }

    public function all()
    {
        return $this->model::all();
    }

    public function findOrFail(int $id)
    {
        return $this->model::with(['categories'])->findOrFail($id);
    }

    public function search(string $search, ?string $order_by = null, ?string $order = 'ASC')
    {
        $query = $this->model
            ->searchTitle($search)
            ->searchDescription($search)
            ->with(['categories']);
        if ($order_by) {
            $query->orderBy($order_by, $order);
        }
        $result = $query->get()->map(function ($item) {
            $item->pivots = $item->categories->pluck('pivot');
            return $item;
        });
        return $result;
    }
}
