<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $prefixes = [
            'นาย',
            'นาง',
            'นางสาว'
        ];

        foreach ($prefixes as $key => $val) {
            DB::table('prefixes')->insert([
                'id' => $key + 1,
                'name' => $val
            ]);
        }
    }
}
