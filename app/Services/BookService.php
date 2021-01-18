<?php

namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookService
{
    /**
     * @var BookRepository
     */
    private BookRepository $bookRepository;

    /**
     * BookService constructor.
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->bookRepository->all();
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        return $this->bookRepository->create($params);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return $this->bookRepository->get($id);
    }

    /**
     * @param array $params
     * @param int $id
     * @return string
     */
    public function update(int $id, array $params): string
    {
        DB::beginTransaction();

        try {
            $category = $this->bookRepository->update($id, $params);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \InvalidArgumentException('Cannot update book');
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
            $category = $this->bookRepository->delete($id);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \InvalidArgumentException('Cannot delete book');
        }

        DB::commit();

        return $category;
    }
}
