<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(\Database\Seeders\AuthorsTableSeeder::class);
         $this->call(\Database\Seeders\CategoriesTableSeeder::class);
         $this->call(\Database\Seeders\UsersTableSeeder::class);
//         $this->call(\Database\Seeders\PusblishTableSeeder::class);
    }
}
