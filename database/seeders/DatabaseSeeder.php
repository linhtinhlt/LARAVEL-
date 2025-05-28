<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->count(10)->create();
        Category::factory()->count(7)->create();
        Post::factory()->count(30)->create()->each(function ($post) {
            Comment::factory()->count(5)->create(['post_id' => $post->id]);
        });
        

    }
}
