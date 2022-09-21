<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart11 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 11;

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

        return view('livewire.chart11', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        ((COUNT(plan_for_future_crisis_situation) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact)) AS percentage,
        plan_for_future_crisis_situation
    FROM
        corona_socio_info.education_covid19_impact
    WHERE
        plan_for_future_crisis_situation IS NOT NULL
    GROUP BY plan_for_future_crisis_situation");

        $data = collect($data)->map(function ($data) {
            return  ["category" => $data->plan_for_future_crisis_situation, "column-1" => number_format($data->percentage, 2)];
        })->toArray();

        return [
            'chart' => [
                'type' => 'bar'
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
                'bar' => [
                    'stacking' => 'normal',
                    'dataLabels' => [
                        'enabled' => true,
                        'inside' => false,
                        'format' => "{point.y:,.2f}" . '%'

                    ]
                ],
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'style' => [
                            'textShadow' => false,
                            'strokeWidth' => 0,
                            'textOutline' => false,
                            'color' => '#323232'
                        ]
                    ],
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'enabled' => false
            ],
            'series' => [[
                'name' => '',
                'stack' => '',
                'color' => "#722A8D",
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
                            'bar'=> [
                                'pointWidth'=> 15,
                                'borderRadius'=>'8px',
                            ],
                            'series'=>[
                                'dataLabels'=>[
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
