<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('foods')->insert([
            [
                'food_name' => 'dumpling',
                'food_brief_description' => 'dumpling asli tiongkok',
                'food_full_description' => 'dumpling asli tiongkok mantapppp',
                'category_id' => 3,
                'food_price' => 80000,
                'food_image' => 'dumpling.jpg'
            ],
            [
                'food_name' => 'capcay',
                'food_brief_description' => 'capcay cak maman',
                'food_full_description' => 'capcay cak maman',
                'category_id' => 1,
                'food_price' => 180000,
                'food_image' => 'capcay.jpg'
            ],
            [
                'food_name' => 'ayam',
                'food_brief_description' => 'ayam asam manis ko aliong',
                'food_full_description' => 'ayam asam manis ko aliong mantappppp',
                'category_id' => 1,
                'food_price' => 280000,
                'food_image' => 'ayam.jpg'
            ],
            [
                'food_name' => 'sake',
                'food_brief_description' => 'sake premium 100%',
                'food_full_description' => 'sake asli china premium 100%',
                'category_id' => 2,
                'food_price' => 680000,
                'food_image' => 'sake.jpg'
            ],
            [
                'food_name' => 'ocha',
                'food_brief_description' => 'green ocha',
                'food_full_description' => 'green ocha mantapppp',
                'category_id' => 2,
                'food_price' => 60000,
                'food_image' => 'matcha.jpg'
            ],
            [
                'food_name' => 'kuotie',
                'food_brief_description' => 'kuotie ci lili',
                'food_full_description' => 'kuotie ci lili mantapppp',
                'category_id' => 3,
                'food_price' => 80000,
                'food_image' => 'kuotie.jpg'
            ],
        ]);
    }
}
