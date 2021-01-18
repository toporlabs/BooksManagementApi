<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model;

    /**
     * @param $id
     * @return Model|null
     */
    public function get(int $id): ?Model;

    /**
     * @param array $params
     * @param int $id
     * @return Model|null
     */
    public function update(int $id, array $params): ?Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function delete(int $id): ?Model;
}
