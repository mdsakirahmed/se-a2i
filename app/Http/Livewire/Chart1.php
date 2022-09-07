<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart1 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 1;

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
                'type' => 'column',
                'className' => 'bar-chart'
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('year'),
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'max'=> 100,
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Students',
                    'style'=>[
                        'fontSize'=>'14px'
                    ]
                ],
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
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
                    ]
                ],
                'series' => [
                    'dataLabels'=> [
                        'enabled'=> true,
                        'rotation'=> 270,
                        'style'=>[
                            'textShadow'=>false,
                            'strokeWidth'=>0,
                            'textOutline'=>false
                        ]
                    ],
                    'pointWidth'=> 30,
                    'borderRadius' => '10px',
                    'innerRadius' => '50%',
                ]
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0,
                'margin'=> 45
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
                'dataLabels'=>[
                    'color'=>'#323232'
                ],
                'data' =>  collect($data)->pluck('male_student')->map(function ($value) {
                    return round($value, 2);
                }),
            ]]
        ];
    }
}
