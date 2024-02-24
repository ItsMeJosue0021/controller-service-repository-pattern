<?php

namespace App\Services\Impl;

use App\Services\TaskService;
use App\Exceptions\TaskNotFoundException;
use App\Repositories\Implementations\TaskRepositoryImpl;

class TaskServiceImpl implements TaskService {

    private $taskRepository;

    public function __construct(TaskRepositoryImpl $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTask() {
        return $this->taskRepository->all();
    }

    public function findTaskById($taskId) {
        return $this->taskRepository->find($taskId);
    }

    public function createTask(array $task) {
        return $this->taskRepository->create($task);
    }

    public function updateTask($taskId, array $task) {

        $task = $this->taskRepository->find($taskId);
        if (!$task) {
            throw new TaskNotFoundException('Task not found');
        }
        return $this->taskRepository->update($task);
    }

    public function deleteTask($taskId) {
        return $this->taskRepository->delete($taskId);
    }
}
