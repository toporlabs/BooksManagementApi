<?php

namespace App\Repositories;

use App\BookCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookCategoryRepository implements Repository
{
    /**
     * @var BookCategory
     */
    private BookCategory $bookCategory;

    /**
     * BookCategoryRepository constructor.
     * @param BookCategory $bookCategory
     */
    public function __construct(BookCategory $bookCategory)
    {
        $this->bookCategory = $bookCategory;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->bookCategory::all();
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        $category = new $this->bookCategory;
        $category->name = $params['name'];
        $category->save();

        return $category->fresh();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return $this->bookCategory->find($id);
    }

    /**
     * @param array $params
     * @param int $id
     * @return Model|null
     */
    public function update(int $id, array $params): ?Model
    {
        $category = $this->bookCategory->find($id);
        $category->name = $params['name'];
        $category->update();

        return $category;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function delete(int $id): ?Model
    {
        $category = $this->bookCategory->find($id);
        $category->delete();

        return $category;
    }
}
