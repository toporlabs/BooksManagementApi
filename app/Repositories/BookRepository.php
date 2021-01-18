<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookRepository implements Repository
{
    /**
     * @var Book
     */
    private Book $book;

    /**
     * BookRepository constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->book::all();
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        $book = new $this->book;
        $book->name = $params['name'];
        $book->category_id = $params['category_id'];
        $book->save();

        return $book->fresh();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return $this->book->find($id);
    }

    /**
     * @param array $params
     * @param int $id
     * @return Model|null
     */
    public function update(int $id, array $params): ?Model
    {
        $book = $this->book->find($id);
        $book->name = $params['name'];
        $book->category_id = $params['category_id'];
        $book->update();

        return $book;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function delete(int $id): ?Model
    {
        $category = $this->book->find($id);
        $category->delete();

        return $category;
    }
}
