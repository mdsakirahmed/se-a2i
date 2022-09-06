<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart24 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 24;
    public $countries, $selected_country, $years, $selected_year;

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

        return view('livewire.chart24', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function change_divition()
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

        $db_data = DB::connection('mysql2')->select("SELECT fiscal_year, country, import_million_usd FROM corona_socio_info.economy_import_country");

        // $this->countries = collect($db_data)->pluck('country')->unique();

        $this->years = collect($db_data)->pluck('fiscal_year')->unique();

        $formated_data = [];
        foreach (collect($db_data)->groupBy('country') as $country => $country_wise_data) {
            if ($this->selected_year) {
                $value = collect($country_wise_data)->where('fiscal_year', $this->selected_year)->sum('import_million_usd') / 1000000;
            } else {
                $value = collect($country_wise_data)->sum('import_million_usd') / 1000000;
            }
            array_push($formated_data, [
                'country' => $country, 'value' => round($value)
            ]);
        }

        //Get data from json file
        $geojson = json_decode(file_get_contents(public_path('assets/json/world.topo.json')), true);


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

            'mapNavigation' => [
                'enabled' => true,
                'buttonOptions' => [
                    'verticalAlign' => "bottom"
                ]
            ],

            'colorAxis' => [
                'tickPixelInterval' => 100,
                'min' => collect($formated_data)->min('value'),
                'max' => collect($formated_data)->max('value'),
                'minColor' => '#cfc5d4',
                'maxColor' => '#7F3F98'
            ],
            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '',
                'pointFormat' => 'Country: {point.country}<br>Import In Usd: {point.value:,.2f}  (Million US$)',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],
            'series' => [
                [
                    'data' => collect($formated_data)->map(function ($data) {
                        return $data;
                    }),
                    'keys' => ["country", "value"],
                    'joinBy' => ['name', 'country'],
                    'states' => [
                        'hover' => [
                            'color' => "#9cc13d"
                        ]
                    ],
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.name}",
                        'color'=> '#323232'
                    ]
                ]
            ]
        ];
    }
}
