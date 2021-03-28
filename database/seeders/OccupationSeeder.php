<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list = [
            'อื่น ๆ',
            'รับจ้าง',
            'ข้าราชการ',
            'เกษตรกร',
            'ค้าขาย',
        ];
        foreach ($list as $key => $item) {
            DB::table('occupations')->insert([
                'id' => $key + 1,
                'name' => $item
            ]);
        }
    }
}
