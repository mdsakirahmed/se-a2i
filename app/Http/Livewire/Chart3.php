<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart3 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 3;

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

        return view('livewire.chart3', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        students_participation_percentage AS students_participation_percentage,
        AVG(rate_of_students_participation_percentage) AS raite_of_students_participation_percentage
        FROM
            (SELECT
                students_participation_percentage,
                (COUNT(*) * 100) / (SELECT
                            COUNT(*)
                        FROM
                            education_covid19_impact) AS rate_of_students_participation_percentage
            FROM
                education_covid19_impact WHERE students_participation_percentage IS NOT NULL
            GROUP BY students_participation_percentage) AS expr_qry
        GROUP BY students_participation_percentage
        ORDER BY students_participation_percentage ASC
        LIMIT 1000");

        array_unshift($data, array_pop($data));

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
                'categories' => collect($data)->pluck('students_participation_percentage'),
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
                        'fontSize' => '15px'
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
                        'inside' => false,
                        'format' => "{point.y:,.2f}" . '%',
                        'color'=> '#323232'
                    ]
                ],
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
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
                'data' =>  collect($data)->pluck('raite_of_students_participation_percentage')->map(function ($value) {
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
