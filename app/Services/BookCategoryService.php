<?php

namespace App\Services;

use App\Repositories\BookCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookCategoryService
{
    /**
     * @var BookCategoryRepository
     */
    private BookCategoryRepository $bookCategoryRepository;

    /**
     * BookCategoryService constructor.
     * @param BookCategoryRepository $bookCategoryRepository
     */
    public function __construct(BookCategoryRepository $bookCategoryRepository)
    {
        $this->bookCategoryRepository = $bookCategoryRepository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->bookCategoryRepository->all();
    }

    /**
     * @param array $params
     * @return string
     */
    public function create(array $params): string
    {
        return $this->bookCategoryRepository->create($params);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return $this->bookCategoryRepository->get($id);
    }

    /**
     * @param int $id
     * @param array $params
     * @return string
     */
    public function update(int $id, array $params): string
    {
        DB::beginTransaction();

        try {
            $category = $this->bookCategoryRepository->update($id, $params);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \InvalidArgumentException('Cannot update category');
        }

        DB::commit();

        return $category;
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        DB::beginTransaction();

        try {
            $category = $this->bookCategoryRepository->delete($id);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \InvalidArgumentException('Cannot delete category');
        }

        DB::commit();

        return $category;
    }
}
