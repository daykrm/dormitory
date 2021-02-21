<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('year_configs')->insert([
            'year' => '2021',
            'startDate' => '2021-02-21',
            'endDate' => '2021-02-21'
        ]);
    }
}
