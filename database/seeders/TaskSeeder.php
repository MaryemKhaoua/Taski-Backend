<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        for ($i = 0; $i < 50; $i++) {
            Task::create([
                'title' => ucfirst($faker->words(rand(2, 4), true)),
                'description' => $faker->sentence(10),
                'status' => $faker->randomElement(['in_progress', 'done']),
                'user_id' => $users->random()->id,
            ]);
        }
    }
}