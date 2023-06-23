<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PusblishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publishing_companies')->truncate();
        DB::table('publishing_companies')->insert([
            'name' => 'Kim đồng',
            'slug' => \Illuminate\Support\Str::slug('Kim Đồng'),
            'products_count' => 0
        ]);
        DB::table('publishing_companies')->insert([
            'name' => 'Giáo dục',
            'slug' => \Illuminate\Support\Str::slug('Giáo dục'),
            'products_count' => 0
        ]);
        DB::table('publishing_companies')->insert([
            'name' => 'Nhã Nam',
            'slug' => \Illuminate\Support\Str::slug('Nhã Nam'),
            'products_count' => 0
        ]);
        DB::table('publishing_companies')->insert([
            'name' => 'Nhà sản xuất đại học sư phạm',
            'slug' => \Illuminate\Support\Str::slug('Nhà sản xuất đại học sư phạm'),
            'products_count' => 0
        ]);
        DB::table('publishing_companies')->insert([
            'name' => 'Nhà sản xuất thông tin và truyền thông',
            'slug' => \Illuminate\Support\Str::slug('Nhà sản xuất Thông tin và Truyền thông'),
            'products_count' => 0
        ]);
    }
}
