<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * @var BookService
     */
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->bookService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        return response()->json($this->bookService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $bookId
     * @return JsonResponse
     */
    public function show(int $bookId): JsonResponse
    {
        return response()->json($this->bookService->get($bookId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bookId
     * @param UpdateBookRequest $request
     * @return JsonResponse
     */
    public function update(int $bookId, UpdateBookRequest $request): JsonResponse
    {
        return response()->json($this->bookService->update($bookId, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $bookId
     * @return JsonResponse
     */
    public function destroy(int $bookId): JsonResponse
    {
        try {
            $this->bookService->delete($bookId);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([], 204);
    }
}
