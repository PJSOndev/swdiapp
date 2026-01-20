<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
  public function run()
  {
    $regions = [
      ['psgc' => '010000000', 'name' => 'REGION I (ILOCOS REGION)'],
      ['psgc' => '020000000', 'name' => 'REGION II (CAGAYAN VALLEY)'],
      ['psgc' => '030000000', 'name' => 'REGION III (CENTRAL LUZON)'],
      ['psgc' => '040000000', 'name' => 'REGION IV-A (CALABARZON)'],
      ['psgc' => '050000000', 'name' => 'REGION V (BICOL REGION)'],
      ['psgc' => '060000000', 'name' => 'REGION VI (WESTERN VISAYAS)'],
      ['psgc' => '070000000', 'name' => 'REGION VII (CENTRAL VISAYAS)'],
      ['psgc' => '080000000', 'name' => 'REGION VIII (EASTERN VISAYAS)'],
      ['psgc' => '090000000', 'name' => 'REGION IX (ZAMBOANGA PENINSULA)'],
      ['psgc' => '100000000', 'name' => 'REGION X (NORTHERN MINDANAO)'],
      ['psgc' => '110000000', 'name' => 'REGION XI (DAVAO REGION)'],
      ['psgc' => '120000000', 'name' => 'REGION XII (SOCCSKSARGEN)'],
      ['psgc' => '130000000', 'name' => 'NATIONAL CAPITAL REGION (NCR)'],
      ['psgc' => '140000000', 'name' => 'CORDILLERA ADMINISTRATIVE REGION (CAR)'],
      ['psgc' => '150000000', 'name' => 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)'],
      ['psgc' => '160000000', 'name' => 'REGION XIII (Caraga)'],
      ['psgc' => '170000000', 'name' => 'MIMAROPA REGION'],
    ];

    DB::table('regions')->insert($regions);
  }
}
