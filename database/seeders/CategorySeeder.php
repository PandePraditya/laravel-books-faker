<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Bulk insert for categories
        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = ['name' => $faker->word];
        }
        category::insert($categories);
    }
}
