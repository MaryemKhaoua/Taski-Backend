<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all() {
        $users = User::all();
        
        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No users found',
            ], 404);
        }
        
        return $users;
    }
}