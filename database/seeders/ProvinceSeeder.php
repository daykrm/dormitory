<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $provinces = [
            'ขอนแก่น',
            'มหาสารคาม'
        ];

        foreach($provinces as $val){
            DB::table('provinces')->insert([
                'name' => $val
            ]);
        }
    }
}
