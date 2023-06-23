<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            'name' => 'Văn học',
            'slug' => 'van-hoc',
            'depth' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'Kinh tế',
            'slug' => 'kinh-te',
            'depth' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'Sách thiếu nhi',
            'slug' => 'sach-thieu-nhi',
            'depth' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'Tâm lý - Kĩ năng sống',
            'slug' => 'tam-ly-ky-nang-song',
            'depth' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'Sách học ngoại ngữ',
            'slug' => 'sach-hoc-ngoai-ngu',
            'depth' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'Văn phòng phẩm',
            'slug' => 'van-phong-pham',
            'depth' => 1
        ]);
    }
}
