<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart1 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 1;

    public function render()
    {
        $this->chart =Chart::findOrFail($this->chart_id);
        if(app()->currentLocale() == 'bn'){
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        }else{
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart1', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        year,
        SUM(total_student) as total_student,
        ((SUM(female_student) * 100) / SUM(total_student)) AS female_student,
        (((SUM(total_student) - SUM(female_student)) * 100) / SUM(total_student)) AS male_student
        FROM
            corona_socio_info.education_statistics
        WHERE
            year IS NOT NULL
        GROUP BY year");

        return [
            'chart' => [
                'type' => 'column'
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('year')
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Students'
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
                    ]
                ],
                'series' => [
                    'dataLabels'=> [
                        'enabled'=> true,
                        'rotation'=> 270,
                        'x'=>'',
                        'y'=>'',
                        'style'=>[
                            'textShadow'=>false,
                            'strokeWidth'=>0,
                            'textOutline'=>false
                        ]
                    ],
                    'pointWidth'=> 20,
                    'borderRadius' => '8px',
                ]
            ],
            'series' => [[
                'name' => 'Male',
                'stack' => 'gender',
                'color' => "#7F3F98",
                'data' => collect($data)->pluck('female_student')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'name' => 'Female',
                'stack' => 'gender',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('male_student')->map(function ($value) {
                    return round($value, 2);
                }),
            ]]
        ];
    }
}
