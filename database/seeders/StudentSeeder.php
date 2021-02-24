<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = strtotime('01/21/1996');

        DB::table('users')->insert([
            'name' => 'ทดสอบ ทดสอบ',
            'prefix_id' => 1,
            'nickname' => 'ทดสอบ',
            'dob' => date('Y/m/d', $date),
            'email' => 'k.anuchit@kkumail.com',
            'username' => 'testtest',
            'password' => Hash::make('123456'),
            'enrolled_year' => '2015',
            'dorm_detail_id' => 1,
            'province_id' => 1,
            'faculty_id' => 1,
            'type_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'ทดสอบ ทดสอบ',
            'prefix_id' => 1,
            'nickname' => 'ทดสอบ',
            'dob' => date('Y/m/d', $date),
            'email' => 'k.anuchit2@kkumail.com',
            'username' => 'testtest2',
            'password' => Hash::make('123456'),
            'enrolled_year' => '2015',
            'dorm_detail_id' => 4,
            'province_id' => 1,
            'faculty_id' => 1,
            'type_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'กรรมการ กรรมการ',
            'prefix_id' => 1,
            'nickname' => 'กรรมการ',
            'dob' => date('Y/m/d', $date),
            'email' => 'council@kkumail.com',
            'username' => 'council',
            'password' => Hash::make('123456'),
            'enrolled_year' => '2014',
            'dorm_detail_id' => 1,
            'province_id' => 1,
            'faculty_id' => 1,
            'type_id' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'กรรมการ2 กรรมการ2',
            'prefix_id' => 1,
            'nickname' => 'กรรมการ',
            'dob' => date('Y/m/d', $date),
            'email' => 'council2@kkumail.com',
            'username' => 'council2',
            'password' => Hash::make('123456'),
            'enrolled_year' => '2014',
            'dorm_detail_id' => 4,
            'province_id' => 1,
            'faculty_id' => 1,
            'type_id' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'prefix_id' => 1,
            'nickname' => 'Admin',
            'dob' => date('Y/m/d', $date),
            'email' => 'admin@kkumail.com',
            'username' => 'adminadmin',
            'password' => Hash::make('123456'),
            'enrolled_year' => '2015',
            'dorm_detail_id' => 1,
            'province_id' => 1,
            'faculty_id' => 1,
            'type_id' => 3,
        ]);
    }
}
