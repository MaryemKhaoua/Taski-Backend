<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    public function index(): JsonResponse {
    $user = Auth::user();

    if (!$user || $user->role !== 'admin') {
        return response()->json([
            'message' => 'Unauthorized. Admins only.'
        ], 403);
    }

    $users = $this->userService->getAllUsers();

    if ($users->isEmpty()) {
        return response()->json([
            'message' => 'No users found.'
        ], 404);
    }

    return response()->json($users, 200);
    }
}