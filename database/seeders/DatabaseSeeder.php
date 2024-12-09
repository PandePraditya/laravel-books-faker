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
    public function run(): void
    {
        $faker = Faker::create();

        // Bulk insert for authors
        $authors = [];
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = ['name' => $faker->name];
        }
        author::insert($authors);

        // Bulk insert for categories
        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = ['name' => $faker->word];
        }
        category::insert($categories);

        // Bulk insert for books
        $authorIds = author::pluck('id')->toArray();
        $categoryIds = category::pluck('id')->toArray();

        $books = [];
        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'author_id' => $authorIds[array_rand($authorIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'title' => $faker->sentence
            ];

            // Insert in chunks to manage memory
            if (count($books) >= 1000) {
                book::insert($books);
                $books = [];
            }
        }
        if (!empty($books)) {
            book::insert($books);
        }

        // Bulk insert for ratings
        $bookIds = book::pluck('id')->toArray();

        $ratings = [];
        for ($i = 0; $i < 500000; $i++) {
            $ratings[] = [
                'book_id' => $bookIds[array_rand($bookIds)],
                'rating' => $faker->numberBetween(1, 10),
            ];

            // Insert in chunks to manage memory
            if (count($ratings) >= 1000) {
                rating::insert($ratings);
                $ratings = [];
            }
        }
        if (!empty($ratings)) {
            rating::insert($ratings);
        }
    }
}
