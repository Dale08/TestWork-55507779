<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Repositories\Book\BookRepository;
use App\Services\Book\ManageBookService;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{

    public function __construct(
        private BookRepository $bookRepository,
        private ManageBookService $manageBookService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->bookRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookRequest $request)
    {
        return $this->manageBookService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return $this->bookRepository->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, int $id)
    {
        return $this->manageBookService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $this->manageBookService->destroy($id);
        return response()->json(['message' => 'Removed']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $order_by = $request->get('order_by', null);
        $order = $request->get('order', 'ASC');
        return $this->bookRepository->search($search, $order_by, $order);
    }
}
