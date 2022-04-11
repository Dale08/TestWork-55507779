<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Repositories\Book\BookRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;

class ManageBookService
{

    public function __construct(
        private BookRepository $bookRepository,
        private CategoryRepository $categoryRepository
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Book
     */
    public function create(BookRequest $request): Book
    {
        $data = $request->all();
        $book = Book::create($data);
        return $this->attachCategory($data['category'], $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Book
     */
    public function update(BookRequest $request, int $id): Book
    {
        $book = $this->bookRepository->findOrFail($id);
        $data = $request->all();
        $book->update($data);
        if (!empty($data['category'])) {
            return $this->attachCategory($data['category'], $book);
        }
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $book = $this->bookRepository->findOrFail($id);
        $book->categories()->detach();
        $book->delete();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $title
     * @param Book $book
     * @return Book
     */
    private function attachCategory(string $title, Book $book): Book
    {
        $category = $this->categoryRepository->findBySlug(Str::slug($title));
        if (!$category) {
            $category = Category::create(
                [
                    'title' => $title,
                    'slug' => Str::slug($title),
                ]
            );
        }
        $book->categories()->attach([$category->id]);
        return $book;
    }
}
