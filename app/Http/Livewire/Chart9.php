<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart9 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 9;

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

        return view('livewire.chart9', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        (SUM(Challenge_not_enough_time) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS Challenge_not_enough_time,
        (SUM(Challenge_insufficient_staff) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS Challenge_insufficient_staff,
        (SUM(challenge_no_administrative_approval) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS challenge_no_administrative_approval,
        (SUM(challenge_insufficient_money) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS challenge_insufficient_money
    FROM
        corona_socio_info.education_covid19_impact");

        $data = collect($data)->map(function ($data) {
            return [
                ["category" => 'Could not provide<br>enough time', "column-1" => number_format($data->Challenge_not_enough_time, 2)],
                ["category" => 'Did not have<br>sufficient staff', "column-1" => number_format($data->Challenge_insufficient_staff, 2)],
                ["category" => 'Did not get<br>necessary admini<br>-strative approvals<br>on time', "column-1" => number_format($data->challenge_no_administrative_approval, 2)],
                ["category" => 'Did not have <br>sufficient money', "column-1" => number_format($data->challenge_insufficient_money, 2)]
            ];
        })->toArray()[0];

        return [
            'chart' => [
                'type' => 'column'
            ],

            'credits' => [
                'enabled' => false
            ],

            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('category'),
                'labels' => [
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Upazila',
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
            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '<b>{point.key}</b><br>',
                'pointFormat' => '{series.name} : {point.y:,.2f} %',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],

            'plotOptions' => [
                'column' => [
                    'stacking' => 'normal',
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.y:,.2f}" . '%',
                        'color'=> '#323232'
                    ]
                ],
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'inside' => false,

                        'style' => [
                            'textShadow' => false,
                            'strokeWidth' => 0,
                            'textOutline' => false
                        ]
                    ],
                    'pointWidth' => 30,
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'enabled' => false
            ],
            'series' => [[
                'name' => '',
                'stack' => '',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                    return round($value, 2);
                }),
            ]],
            'responsive'=> [
                'rules'=> [[
                    'condition'=> [
                        'maxWidth'=> 500
                    ],
                    'chartOptions'=> [
                        'plotOptions'=> [
                            'column'=> [
                                'pointWidth'=> 15,
                                'borderRadius'=>'8px',
                                'dataLabels'=>[
                                    'inside' => true,
                                ]
                            ],
                            'series'=>[
                                'dataLabels'=>[
                                    'rotation'=> 270,
                                    'style'=>[
                                        'fontSize'=>'10px'
                                    ]
                                ]
                            ]    
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
                                'rotation'=>270,
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
