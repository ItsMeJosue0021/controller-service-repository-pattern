<?php

namespace App\Services;

interface TaskService {
    public function getAllTask();
    public function findTaskById($id);
    public function createTask(array $data);
    public function updateTask($id, array $data);
    public function deleteTask($id);
}
