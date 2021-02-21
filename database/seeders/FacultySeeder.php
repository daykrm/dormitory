<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculties')->insert([
            'name' => 'ศึกษาศาสตร์',
            'years' => 5
        ]);

        DB::table('faculties')->insert([
            'name' => 'วิทยาศาสตร์',
            'years' => 4
        ]);
    }
}
