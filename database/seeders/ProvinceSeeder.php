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

        foreach($provinces as $key => $val){
            DB::table('provinces')->insert([
                'id' => $key + 1,
                'name' => $val
            ]);
        }
    }
}
