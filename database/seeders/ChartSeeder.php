<?php

namespace Database\Seeders;

use App\Models\Chart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chart::create([
            [ // chart id 1
                'bn_name' => '', 
                'en_name' => '',
                'bn_datasource' => '',
                'en_datasource' => '',
                'bn_description' => '',
                'en_description' => '',
            ],
            [ // chart id 2
                'bn_name' => '', 
                'en_name' => '',
                'bn_datasource' => '',
                'en_datasource' => '',
                'bn_description' => '',
                'en_description' => '',
            ],
        ]);
    }
}
