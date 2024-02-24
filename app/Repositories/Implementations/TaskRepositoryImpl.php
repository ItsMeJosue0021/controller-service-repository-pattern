<?php

namespace App\Repositories\Implementations;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskRepositoryImpl implements TaskRepository {
    public function all() {
        return Task::latest()->paginate(2);
    }

    public function find($id) {
        return Task::find($id);
    }

    public function create(array $data) {
        return Task::create($data);
    }

    public function update(array $data) {
        return Task::update($data);
    }

    public function delete($id) {
        return Task::destroy($id);
    }
}
