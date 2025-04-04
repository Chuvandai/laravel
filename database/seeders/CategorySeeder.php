<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category=[];
        $faker= Faker::create();
        for($i=0; $i<5; $i++){
           $category[]=[
                'name' => $faker->name,
                'status' => $faker->boolean,
            ];
        }
        DB::table('categories')->insert($category);
    }
}
