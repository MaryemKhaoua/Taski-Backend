<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::with('user')->get();
    }

    public function allByUser($authUser)
    {
        return Task::with('user')
            ->where('user_id', $authUser->id)
            ->get();
    }

    public function findAny($id)
    {
        return Task::with('user')->find($id);
    }

public function find($id, $authUser)
{
    if ($authUser->role === 'admin') {
        return Task::find($id);
    }

    return Task::where('id', $id)
        ->where('user_id', $authUser->id)
        ->first();
}

    public function create(array $data)
    {
        $task = Task::create($data);
        return $task->load('user');
    }

public function update($id, array $data, $authUser)
{
    $task = $this->find($id, $authUser);

    if (!$task) {
        return null;
    }

    $task->update($data);
    return $task->fresh();
}

    public function delete($id)
    {
        return Task::destroy($id);
    }
}