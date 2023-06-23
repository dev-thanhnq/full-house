<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0342956205',
            'address' => 'Sài Gòn',
            'is_protected' => 1,
            'role' => 0,
            'password' => bcrypt('123456')
        ]);

        DB::table('users')->insert([
            'name' => 'Nhân viên',
            'email' => 'nhanvien@gmail.com',
            'phone' => '0342956666',
            'address' => 'Quảng Nam',
            'is_protected' => 0,
            'role' => 1,
            'password' => bcrypt('123456')
        ]);

    }
}
