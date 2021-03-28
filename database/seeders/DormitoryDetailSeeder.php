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
            'id' => 1,
            'dormitory_id' => 1,
            'room_id' => 1
        ]);

        DB::table('dormitory_details')->insert([
            'id' => 2,
            'dormitory_id' => 1,
            'room_id' => 2
        ]);

        DB::table('dormitory_details')->insert([
            'id' => 3,
            'dormitory_id' => 1,
            'room_id' => 3
        ]);

        DB::table('dormitory_details')->insert([
            'id' => 4,
            'dormitory_id' => 2,
            'room_id' => 1
        ]);

        DB::table('dormitory_details')->insert([
            'id' => 5,
            'dormitory_id' => 2,
            'room_id' => 2
        ]);

        DB::table('dormitory_details')->insert([
            'id' => 6,
            'dormitory_id' => 2,
            'room_id' => 3
        ]);
    }
}
