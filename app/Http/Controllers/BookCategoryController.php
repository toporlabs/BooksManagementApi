<?php

namespace App\Http\Controllers;

use App\BookCategory;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;
use App\Services\BookCategoryService;
use Illuminate\Http\JsonResponse;

class BookCategoryController extends Controller
{
    /**
     * @var BookCategoryService
     */
    private BookCategoryService $bookCategoryService;

    public function __construct(BookCategoryService $bookCategoryService)
    {
        $this->bookCategoryService = $bookCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->bookCategoryService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookCategoryRequest $request): JsonResponse
    {
        return response()->json($this->bookCategoryService->create($request->validated()));

    }

    /**
     * Display the specified resource.
     *
     * @param int $bookCategoryId
     * @return JsonResponse
     */
    public function show(int $bookCategoryId): JsonResponse
    {
        return response()->json($this->bookCategoryService->get($bookCategoryId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bookCategoryId
     * @param UpdateBookCategoryRequest $request
     * @return JsonResponse
     */
    public function update(int $bookCategoryId, UpdateBookCategoryRequest $request): JsonResponse
    {
        return response()->json($this->bookCategoryService->update($bookCategoryId, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BookCategory $bookCategory
     * @return JsonResponse
     */
    public function destroy(BookCategory $bookCategory): JsonResponse
    {
        $response = ['status' => 200];

        try {
            $response['data'] = $this->bookCategoryService->delete($bookCategory->id);
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($response, $response['status']);
    }
}
