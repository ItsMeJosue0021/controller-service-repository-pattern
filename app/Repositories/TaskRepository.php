<?php

namespace App\Repositories;

interface TaskRepository {
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
