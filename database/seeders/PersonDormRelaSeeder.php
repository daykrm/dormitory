<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonDormRelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('person_dorm_relas')->insert([
            'dorm_id' => 1,
            'personel_id' => 1,
        ]);

        DB::table('person_dorm_relas')->insert([
            'dorm_id' => 2,
            'personel_id' => 1,
        ]);
    }
}
