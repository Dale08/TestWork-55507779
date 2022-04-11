<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(private EloquentCategoryRepository $categoryRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->categoryRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        return Category::create(
            [
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['description']
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, int $id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        $category->books()->detach();
        $category->delete();
        return response()->json(['message' => 'Removed']);
    }
}
