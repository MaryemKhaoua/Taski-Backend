<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $user = Auth::user();
        $tasks = $this->taskService->getAllTasks($user);

        return response()->json($tasks, 200);
    }

    public function show($id)
    {
        $user = Auth::user();
        $task = $this->taskService->getTaskById($id, $user);

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        return response()->json($task, 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Only admins can create tasks'], 403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = $this->taskService->createTask($data);

        return response()->json($task, 201);
    }

public function update(Request $request, $id)
{
    $user = Auth::user();
    
    $data = $request->validate([
        'title' => 'sometimes|string|max:255',
        'description' => 'nullable|string',
        'status' => 'sometimes|in:pending,in_progress,done',
    ]);

    $updatedTask = $this->taskService->updateTask($id, $data, $user);

    if (!$updatedTask) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    return response()->json($updatedTask, 200);
}

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Only admins can delete tasks'], 403);
        }

        $task = $this->taskService->getTaskById($id, $user);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $this->taskService->deleteTask($id);

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}