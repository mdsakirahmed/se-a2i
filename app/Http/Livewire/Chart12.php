<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart12 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 12;

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

        return view('livewire.chart12', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        year,
        SUM(IF(country_code = 'BGD', gdp_per_capita, 0)) AS bangladesh,
        SUM(IF(country_code = 'IND', gdp_per_capita, 0)) AS india,
        SUM(IF(country_code = 'PAK', gdp_per_capita, 0)) AS pakistan
        FROM
            corona_socio_info.economy_real_capita
        WHERE year >= '2005-06'
        GROUP BY year");

        // dd(collect($data));

        $real_gdp_per_capita_years_data_set['year'] =
            $real_gdp_per_capita_years_data_set['bangladesh'] =
            $real_gdp_per_capita_years_data_set['india'] =
            $real_gdp_per_capita_years_data_set['pakistan'] =
            array();
        foreach (collect($data) as $data_of_a_year) {
            array_push($real_gdp_per_capita_years_data_set['year'], (int) $data_of_a_year->year);
            array_push($real_gdp_per_capita_years_data_set['bangladesh'], (float) number_format($data_of_a_year->bangladesh,  2, '.', ''));
            array_push($real_gdp_per_capita_years_data_set['india'], (float) number_format($data_of_a_year->india,  2, '.', ''));
            array_push($real_gdp_per_capita_years_data_set['pakistan'], (float) number_format($data_of_a_year->pakistan,  2, '.', ''));
        }

        return [
            'chart' => [
                'type' => 'spline',
                'zoomType' => 'xy'
            ],

            'credits' => [
                'enabled' => false
            ],

            'title' => [
                'text' => ''
            ],

            'subtitle' => [
                'text' => ''
            ],

            'legend' => [
                'symbolWidth' => 80
            ],

            'xAxis' => [
                'categories' => $real_gdp_per_capita_years_data_set['year'],
                'accessibility' => [
                    'rangeDescription' => ''
                ],
                'labels' => [
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],

            'yAxis' => [
                'title' => [
                    'text' => 'GDP per Capita at Current Market Prices (US$)',
                    'style' => [
                        'fontSize' => '14px'
                    ]
                ],
                'labels' => [
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],
            'legend' => [
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin' => 45
            ],

            'plotOptions' => [
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => ''
                    ],
                ]
            ],

            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '<b>{point.key}</b><br>',
                'pointFormat' => '{series.name} : {point.y} (US$)',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],

            'series' => [[
                'name' => 'Bangladesh',
                'color' => "#7F3F98",
                'data' =>   $real_gdp_per_capita_years_data_set['bangladesh'],
            ], [
                'name' => 'India',
                'color' => "#83C341",
                'data' =>  $real_gdp_per_capita_years_data_set['india'],
            ], [
                'name' => 'Pakistan',
                'color' => "#FFB207",
                'data' =>  $real_gdp_per_capita_years_data_set['pakistan'],
            ]],

            'responsive' => [
                'rules' => [[
                    'condition' => [
                        'maxWidth' => 500
                    ],
                    'chartOptions' => [
                        'legend' => [
                            'layout' => 'horizontal',
                            'align' => 'center',
                            'verticalAlign' => 'bottom'
                        ],
                        'yAxis'=>[
                            'title' => [
                                'text' => 'Percentage of Students',
                                'style'=>[
                                    'fontSize'=>'12px'
                                ]
                            ],
                            'labels'=>[
                                'style'=>[
                                    'fontSize'=>'10px'
                                ]
                            ]
                        ],
                        'xAxis'=>[
                            'labels'=>[
                                'style'=>[
                                    'fontSize'=>'10px'
                                ]
                            ]
                        ]
                    ]
                ]]
            ]
        ];
    }
}
