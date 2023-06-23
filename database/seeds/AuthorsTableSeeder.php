<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->truncate();
        DB::table('authors')->insert([
            'name' => 'Nguyễn Ngọc Ánh ',
            'slug' => 'nguyen-ngoc-anh',
        ]);
        DB::table('authors')->insert([
            'name' => 'Nhiều tác giả',
            'slug' => 'nhieu-tac-gia',
        ]);
    }
}
