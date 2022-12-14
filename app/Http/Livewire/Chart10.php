<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart10 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 10;

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

        return view('livewire.chart10', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        (SUM(new_step_distribute_education_materials) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS new_step_distribute_education_materials,
        (SUM(new_step_support_student) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS new_step_support_student,
        (SUM(new_step_support_teacher) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS new_step_support_teacher,
        (SUM(New_step_no_step_taken) * 100) / (SELECT 
                COUNT(upazila)
            FROM
                corona_socio_info.education_covid19_impact) AS New_step_no_step_taken
    FROM
        corona_socio_info.education_covid19_impact");

        $data = collect($data)->map(function ($data) {
            return  [
                ["category" => 'Distribution <br>of education <br> materials', "column-1" => number_format($data->new_step_distribute_education_materials, 2)],
                ["category" => 'Support to the <br>students for <br>attending the<br> online classes', "column-1" => number_format($data->new_step_support_student, 2)],
                ["category" => 'Support to the <br>teachers for <br>conducting the<br> online classes', "column-1" => number_format($data->new_step_support_teacher, 2)],
                ["category" => 'No new steps <br>taken', "column-1" => number_format($data->New_step_no_step_taken, 2)]
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
                'enabled' => false,
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
