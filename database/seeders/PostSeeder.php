<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all users
        $users = User::all();

        // Create posts for each user
        foreach ($users as $user) {
            for ($i = 0; $i < 4; $i++) { // Adjust the number of posts as needed
                Post::create([
                    'user_id' => $user->id,
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                ]);
            }
        }
    }
}
