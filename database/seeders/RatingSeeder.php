<?php

namespace Database\Seeders;

use App\Models\book;
use App\Models\rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

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
