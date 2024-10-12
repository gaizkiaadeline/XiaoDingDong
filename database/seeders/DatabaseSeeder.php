<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(CountrySeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin'
        ]);

        User::factory()->create([
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin234'),
            'role' => 'Admin'
        ]);

        User::factory()->create([
            'username' => 'member',
            'email' => 'member@gmail.com',
            'password' => bcrypt('member123'),
            // 'role' => 'Xiao User'
        ]);

    }
}
