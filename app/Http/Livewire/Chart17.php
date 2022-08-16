<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart17 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 17;
    public $selected_districts = [],  $selected_divisions = [];
    public $years, $selected_year;

    public function render()
    {
        $this->chart = Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart17', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function update_chart()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {

        $data = DB::connection('mysql2')->select("SELECT year, division, district, sum(remittance_in_million_usd) as total_remitance_usd
                FROM corona_socio_info.economy_remittance_districtwise group by year, division, district");


        $this->years = collect($data)->pluck('year')->unique();
        $districts = [];
        foreach (collect($data)->groupBy('district') as $district => $district_data) {
            if ($this->selected_year) {
                $value = collect($district_data)->where('year', $this->selected_year)->sum('total_remitance_usd');
            } else {
                $value = collect($district_data)->sum('total_remitance_usd');
            }
            // ** DB district are Upercase but out json file is not same as a string, that is why whe change DISTRICT to District format value by ucfirst(strtolower(trans($district)))
            array_push($districts, [
                ucfirst(strtolower(trans($district))), round($value) 
            ]);
        }

        //Get data from json file
        $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

        //Filter data
        $filter_geojson = $geojson;
        $filter_geojson['features'] = [];
        $filter_districts = [];
        foreach ($geojson['features'] as $feature) {
            if ($this->selected_districts && $this->selected_divisions) {
                if ($feature['properties']['district'] == $this->selected_districts && $feature['properties']['division'] == $this->selected_divisions) {
                    array_push($filter_geojson['features'], $feature);
                    array_push($filter_districts, $feature['properties']['district']);
                }
            } else if ($this->selected_districts && !$this->selected_divisions) {
                if ($feature['properties']['district'] == $this->selected_districts) {
                    array_push($filter_geojson['features'], $feature);
                }
            } else if (!$this->selected_districts && $this->selected_divisions) {
                $this->districts = [];
                if ($feature['properties']['division'] == $this->selected_divisions) {
                    array_push($filter_geojson['features'], $feature);
                    array_push($filter_districts, $feature['properties']['district']);
                }
            } else {
                array_push($filter_geojson['features'], $feature);
                array_push($filter_districts, $feature['properties']['district']);
            }
        }
        $geojson = $filter_geojson;
        $this->districts = $filter_districts;

        //Make map data set
        return [
            'chart' => [
                'map' => collect($geojson)
            ],

            'title' => [
                'text' => ""
            ],

            'accessibility' => [
                'typeDescription' => ""
            ],

            'mapNavigation' => [
                'enabled' => true,
                'buttonOptions' => [
                    'verticalAlign' => "bottom"
                ]
            ],

            'colorAxis' => [
                'tickPixelInterval' => 100
            ],

            'series' => [
                [
                    'data' => $districts,
                    'keys' => ["district", "value"],
                    'joinBy' => "district",
                    'name' => "Moderate to Severe Food Insecurity",
                    'states' => [
                        'hover' => [
                            'color' => "#a4edba"
                        ]
                    ],
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.properties.district}"
                    ]
                ]
            ]
        ];
    }
}
