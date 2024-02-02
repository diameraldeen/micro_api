<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Faker\Factory as Faker;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Blog::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'publication_date' => $faker->date,
            ]);
        }
    }
}