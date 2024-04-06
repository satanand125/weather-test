<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['city_name' => 'Abu Dhabi, UAE'],
            ['city_name' => 'Dubai, UAE'],
            ['city_name' => 'Sharjah, UAE'],
            ['city_name' => 'London, UK'],
            ['city_name' => 'New York, USA'],
            ['city_name' => 'Tokyo, Japan'],
        ];
        DB::table('cities')->insert($cities);
    }
}
