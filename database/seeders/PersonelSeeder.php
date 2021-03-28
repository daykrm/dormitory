<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('personels')->insert([
            'id' => 1,
            'name' => 'Personel Test',
            'username' => 'personels',
            'password' => Hash::make('123456'),
            'email' => 'personel@gmail.com',
            'prefix_id' => 1,
            //'dorm_id' => 1,
        ]);
    }
}
