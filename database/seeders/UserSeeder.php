<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // ✅ Utilisateurs fixes
        $fixedUsers = [
            [
                'first_name' => 'user',
                'last_name' => 'khaoua',
                'username' => 'user',
                'password' => Hash::make('Password@123'),
                'role' => 'user',
            ],
            [
                'first_name' => 'admin',
                'last_name' => 'khaoua',
                'username' => 'admin',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
            ],
        ];

        foreach ($fixedUsers as $user) {
            User::create($user);
        }

        // ✅ Utilisateurs aléatoires
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->unique()->userName,
                'password' => Hash::make('Password@123'),
                'role' => 'user',
            ]);
        }
    }
}