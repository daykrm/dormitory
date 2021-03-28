<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rooms = [
            '101', '102', '103'
        ];

        foreach ($rooms as $key => $val) {
            DB::table('rooms')->insert([
                'id' => $key + 1,
                'name' => $val
            ]);
        }
    }
}
