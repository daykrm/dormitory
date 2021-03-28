<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegisterRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('register_ranges')->insert([
            'id' => 1,
            'startDate' => '2021-03-01',
            'endDate' => '2021-04-25'
        ]);
    }
}
