<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dorm = [
            'หอพักชายที่ 5',
            'หอพักชายที่ 7'
        ];

        foreach ($dorm as $val) {
            DB::table('dormitories')->insert([
                'name' => $val
            ]);
        }
    }
}
