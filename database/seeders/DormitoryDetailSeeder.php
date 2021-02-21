<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DormitoryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('dormitory_details')->insert([
            'dormitory_id' => 1,
            'room_id' => 1
        ]);

        DB::table('dormitory_details')->insert([
            'dormitory_id' => 1,
            'room_id' => 2
        ]);

        DB::table('dormitory_details')->insert([
            'dormitory_id' => 1,
            'room_id' => 3
        ]);

        DB::table('dormitory_details')->insert([
            'dormitory_id' => 2,
            'room_id' => 1
        ]);

        DB::table('dormitory_details')->insert([
            'dormitory_id' => 2,
            'room_id' => 2
        ]);

        DB::table('dormitory_details')->insert([
            'dormitory_id' => 2,
            'room_id' => 3
        ]);
    }
}
