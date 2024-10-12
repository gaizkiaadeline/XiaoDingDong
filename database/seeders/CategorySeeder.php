<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name' => '主菜 | Main Course'
            ],
            [
                'category_name' => '饮料 | Beverage'
            ],
            [
                'category_name' => '甜点 | Dessert'
            ]
        ]);
    }
}
