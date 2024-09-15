<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\author;
use App\Models\book;
use App\Models\category;
use App\Models\rating;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // NB: inRandomOrder means that the query will be ordered randomly
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 1000 fake authors
        for ($i = 0; $i < 1000; $i++) {
            author::create([
                'name' => $faker->name
            ]);
        }

        // Generate 3000 fake book categories
        for ($i = 0; $i < 3000; $i++) {
            category::create([
                'name' => $faker->word
            ]);
        }

        // Generate 100,000 fake books
        for ($i = 0; $i < 100000; $i++) {
            book::create([
                'author_id' => author::inRandomOrder()->first()->id,
                'category_id' => category::inRandomOrder()->first()->id,
                'title' => $faker->sentence
            ]);
        }

        // Generate 500,000 fake ratings
        for ($i = 0; $i < 500000; $i++) {
            rating::create([
                'book_id' => book::inRandomOrder()->first()->id,
                'rating' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
