<?php

namespace App\Repositories\Contracts;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
interface TaskRepositoryInterface
{
     public function paginate(
        array $filters = [],
        int $perPage = 10
    ): LengthAwarePaginator;

    public function findOrFail(int $id): Task;

    public function create(array $data): Task;

    public function update(int $id, array $data): Task;

    public function delete(int $id): bool;
}
