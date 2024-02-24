<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\UpdateTaskRequest;
use App\Exceptions\TaskNotFoundException;
use App\Services\Implementations\TaskServiceImpl;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return TaskResource::collection($this->taskService->getAllTask());
    }

    public function show($taskId)
    {
        $task = $this->taskService->findTaskById($taskId);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }
        return new TaskResource($task);
    }

    public function store(TaskRequest $request)
    {
        try {
            $taskData = $request->validated();
            $task = $this->taskService->createTask($taskData);

            return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($taskId, UpdateTaskRequest $request)
    {
        try {
            $taskData = $request->validated();
            $task = $this->taskService->updateTask($taskId, $taskData);

            return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_OK);
        } catch (TaskNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

    }
}
