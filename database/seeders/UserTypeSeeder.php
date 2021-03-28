<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_types')->insert([
            'id' => 1,
            'name' => 'Student'
        ]);

        DB::table('user_types')->insert([
            'id' => 2,
            'name' => 'Council'
        ]);

        DB::table('user_types')->insert([
            'id' => 3,
            'name' => 'Admin'
        ]);
    }
}
