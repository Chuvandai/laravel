<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $category = DB::table('categories')->pluck('id');
        for($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'price' => $faker->numberBetween(10000, 1000000),
                'img' => $faker->imageUrl(),
                'category_id' => $faker->randomElement($category),
                'status' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
