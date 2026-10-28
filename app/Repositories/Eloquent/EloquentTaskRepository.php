<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function __construct(
        private readonly Task $model
    ) {}

    public function paginate(
        array $filters = [],
        int $perPage = 10
    ): LengthAwarePaginator {
        $query = $this->model->newQuery();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['due_date'])) {
            $query->whereDate('due_date', $filters['due_date']);
        }

        return $query
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findOrFail(int $id): Task
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data): Task
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Task
    {
        $task = $this->findOrFail($id);

        $task->update($data);

        return $task->refresh();
    }

    public function delete(int $id): bool
    {
        $task = $this->findOrFail($id);

        return (bool) $task->delete(); //devuelve true si se eliminó correctamente, false si no se pudo eliminar
    }
}