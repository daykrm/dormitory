<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Geography;
use App\Models\Province;
use App\Models\SubDistrict;
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
        $file = public_path('provinces.csv');
        $provinceArr = $this->csvToArray($file);

        for ($i = 0; $i < count($provinceArr); $i++) {
            Province::firstOrCreate($provinceArr[$i]);
        }

        $file = public_path('districts.csv');
        $districts = $this->csvToArray($file);

        for ($i = 0; $i < count($districts); $i++) {
            District::firstOrCreate($districts[$i]);
        }

        $file = public_path('subdistricts.csv');
        $districts = $this->csvToArray($file);

        for ($i = 0; $i < count($districts); $i++) {
            SubDistrict::firstOrCreate($districts[$i]);
        }

        $file = public_path('geographies.csv');
        $districts = $this->csvToArray($file);

        for ($i = 0; $i < count($districts); $i++) {
            Geography::firstOrCreate($districts[$i]);
        }
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) != false) {
            while (($rw = fgetcsv($handle, 1000, $delimiter)) != false) {
                if (!$header) $header = $rw;
                else $data[] = array_combine($header, $rw);
            }
            fclose($handle);
        }

        return $data;
    }
}
