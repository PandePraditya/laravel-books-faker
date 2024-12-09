<?php

namespace Database\Seeders;

use App\Models\author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
