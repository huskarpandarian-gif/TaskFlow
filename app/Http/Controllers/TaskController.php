<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $tasks
    ) {}

    public function index(Request $request): View
    {
        $filters = $request->only([
            'status',
            'priority',
            'due_date',
        ]);

        $tasks = $this->tasks->getPaginatedTasks(
            $filters,
            2
        );

        return view('tasks.index', compact('tasks', 'filters'));
    }

    public function create(): View
    {
        $statuses = TaskStatus::cases();
        $priorities = TaskPriority::cases();

        return view(
            'tasks.create',
            compact('statuses', 'priorities')
        );
    }

    public function store(
        StoreTaskRequest $request
    ): RedirectResponse {
        $this->tasks->createTask($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    public function show(int $task): View
    {
        $task = $this->tasks->getTask($task);

        return view('tasks.show', compact('task'));
    }

    public function edit(int $task): View
    {
        $task = $this->tasks->getTask($task);

        $statuses = TaskStatus::cases();
        $priorities = TaskPriority::cases();

        return view(
            'tasks.edit',
            compact('task', 'statuses', 'priorities')
        );
    }

    public function update(
        UpdateTaskRequest $request,
        int $task
    ): RedirectResponse {
        $this->tasks->updateTask(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(int $task): RedirectResponse
    {
        $this->tasks->deleteTask($task);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }
}