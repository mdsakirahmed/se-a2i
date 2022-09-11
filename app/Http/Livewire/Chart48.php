<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart48 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 48;
    public $years, $districts, $divisions, $selected_year, $selected_district, $selected_division;

    public function render()
    {
        $this->chart = Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
            $this->datasource = $this->chart->bn_datasource;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
            $this->datasource = $this->chart->en_datasource;
        }

        return view('livewire.chart48', [
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

        $db_data = DB::connection('mysql2')->select("SELECT
        year, division, district, subdistrict, upper FROM corona_socio_info.poverty_yearly_upazilawise;");

        $this->years = collect($db_data)->pluck('year')->unique();

        $formated_data = [];
        foreach (collect($db_data)->groupBy('subdistrict') as $subdistrict => $subdistrict_wise_data) {
            if ($this->selected_year) {
                $value = collect($subdistrict_wise_data)->where('year', $this->selected_year)->sum('upper');
            } else {
                $value = collect($subdistrict_wise_data)->sum('upper');
            }
            // echo(ucwords(strtolower(trans($subdistrict))).": $value </br>");
            array_push($formated_data, [
                'value' => round($value), 
                'subdistrict' => ucwords(strtolower(trans($subdistrict))), 
                'district' => ucwords(strtolower(trans(collect($subdistrict_wise_data)->first()->district))),
                'division' => ucwords(strtolower(trans(collect($subdistrict_wise_data)->first()->division)))
            ]);
        }

        $this->divisions = collect($formated_data)->pluck('division')->unique();
        $this->districts = collect($formated_data)->pluck('district')->unique();
        $this->subdistricts = collect($formated_data)->pluck('subdistrict')->unique();

        // if ($this->selected_division) {
        //     $this->districts = collect($formated_data)->where('division', $this->selected_division)->pluck('district');
        // } else {
        //     $this->districts = collect($formated_data)->pluck('district');
        // }

        //Get data from json file
        $geojson = json_decode(file_get_contents(public_path('assets/json/bangladesh.geojson.json')), true);

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

            'credits' => [
                'enabled' => false
            ],

            'title' => [
                'text' => ""
            ],

            'accessibility' => [
                'typeDescription' => ""
            ],
            'legend' => [
                'enabled' => false
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
                'pointFormat' => 'Division: {point.division}<br>District: {point.district}<br>Remittance (In Million Us$): {point.value:,.2f}',
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
                    'data' => collect($formated_data)->map(function ($data) {
                        echo ("Division:". $data['division'] ."District:". $data['district'] ."Subdistrict:". $data['subdistrict']. "Value:". $data['value'] ."</br>");
                        return [$data['division'], $data['district'], $data['subdistrict'], $data['value']];
                    }),
                    'keys' => ["division", "district", "subdistrict", "value"],
                    'joinBy' => "subdistrict",
                    'name' => "Remittance In Million USD",
                    'states' => [
                        'hover' => [
                            'color' => "#9cc13d"
                        ]
                    ],
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.properties.subdistrict} ",
                        'style' => [
                            'textShadow' => false,
                            'strokeWidth' => 0,
                            'textOutline' => false,
                            'color' => '#323232'
                        ]
                    ]
                ]
            ]
        ];
    }
}
