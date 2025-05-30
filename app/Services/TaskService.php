<?php

namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks($authUser)
    {
        if ($authUser->role === 'admin') {
            return $this->taskRepository->all();
        }
        return $this->taskRepository->allByUser($authUser);
    }

    public function getTaskById($id, $authUser)
    {
        if ($authUser->role === 'admin') {
            return $this->taskRepository->findAny($id);
        }
        return $this->taskRepository->find($id, $authUser);
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data, $authUser)
    {
        $updatedTask = $this->taskRepository->update($id, $data, $authUser);

        if (!$updatedTask) {
            throw new \Exception("Task not found or unauthorized");
        }

        return $updatedTask;
    }

    public function deleteTask($id)
    {
        return $this->taskRepository->delete($id);
    }
}