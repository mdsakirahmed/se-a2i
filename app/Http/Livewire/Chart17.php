<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart17 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 17;
    public $years, $districts, $divisions, $selected_year, $selected_district, $selected_division;

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

    public function change_division()
    {
        $this->selected_district = null;
        $this->update_chart();
    }

    public function update_chart()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {

        $db_data = DB::connection('mysql2')->select("SELECT year, division, district, sum(remittance_in_million_usd) as total_remitance_usd
                FROM corona_socio_info.economy_remittance_districtwise group by year, division, district");

        $this->years = collect($db_data)->pluck('year')->unique();

        $formated_data = [];
        foreach (collect($db_data)->groupBy('district') as $district => $district_wise_data) {
            if ($this->selected_year) {
                $value = collect($district_wise_data)->where('year', $this->selected_year)->sum('total_remitance_usd');
            } else {
                $value = collect($district_wise_data)->sum('total_remitance_usd');
            }
            array_push($formated_data, [
                'district' => ucfirst(strtolower(trans($district))), 'value' => round($value), 'division' => ucfirst(strtolower(trans(collect($district_wise_data)->first()->division)))
            ]);
        }
        
        $this->divisions = collect($formated_data)->pluck('division')->unique();

        if($this->selected_division){
            $this->districts = collect($formated_data)->where('division', $this->selected_division)->pluck('district');
        }else{
            $this->districts = collect($formated_data)->pluck('district');
        }

        //Get data from json file
        $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

        //Filter data
        $filter_geojson = $geojson;
        $filter_geojson['features'] = [];
        foreach ($geojson['features'] as $feature) {
            if ($this->selected_district && $this->selected_division) {
                if ($feature['properties']['district'] == $this->selected_district && $feature['properties']['division'] == $this->selected_division) {
                    array_push($filter_geojson['features'], $feature);
                }
            } else if ($this->selected_district && !$this->selected_division) {
                if ($feature['properties']['district'] == $this->selected_district) {
                    array_push($filter_geojson['features'], $feature);
                }
            } else if (!$this->selected_district && $this->selected_division) {
                if ($feature['properties']['division'] == $this->selected_division) {
                    array_push($filter_geojson['features'], $feature);
                }
            } else {
                array_push($filter_geojson['features'], $feature);
            }
        }
        $geojson = $filter_geojson;

        //Make map data set
        return [
            'chart' => [
                'map' => collect($geojson)
            ],

            'credits'=>[
                'enabled'=>false
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
            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '',
                'pointFormat' => 'Division: {point.division}<br>District: {point.district}<br>Remittance In Million Usd:	{point.value:,.2f}',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],

            'colorAxis' => [
                'tickPixelInterval' => 100,
                'min' => collect($formated_data)->min('value'),
                'max' => collect($formated_data)->max('value'),
                'type' => 'logarithmic',
                'minColor' => '#cfc5d4',
                'maxColor' => '#7F3F98'
            ],

            'series' => [
                [
                    'data' => collect($formated_data)->map(function($data){
                        return [$data['division'], $data['district'], $data['value']];
                    }),
                    'keys' => ["division", "district", "value"],
                    'joinBy' => "district",
                    'name' => "Remittance In Million USD",
                    'states' => [
                        'hover' => [
                            'color' => "#9cc13d"
                        ]
                    ],
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.properties.district}",
                        'style'=>[
                            'textShadow'=>false,
                            'strokeWidth'=>0,
                            'textOutline'=>false,
                            'color'=> '#000'
                        ]
                    ]
                ]
            ]
        ];
    }
}
