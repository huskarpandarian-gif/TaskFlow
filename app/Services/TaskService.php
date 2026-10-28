<?php

namespace App\Services;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(
        private readonly TaskRepositoryInterface $tasks
    ) {}

    public function getPaginatedTasks(
        array $filters = [],
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->tasks->paginate($filters, $perPage);
    }

    public function getTask(int $id): Task
    {
        return $this->tasks->findOrFail($id);
    }

    public function createTask(array $data): Task
    {
        $data['priority'] = $data['priority']
            ?? TaskPriority::MEDIUM;

        $data['status'] = $data['status']
            ?? TaskStatus::PENDING;

        return $this->tasks->create($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        return $this->tasks->update($id, $data);
    }

    public function deleteTask(int $id): bool
    {
        return $this->tasks->delete($id);
    }
}