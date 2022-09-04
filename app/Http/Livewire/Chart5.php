<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart5 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 5;

    public function render()
    {
        $this->chart =Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart5', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        man.device_access,
        man.internet_access,
        man.no_internet_access,
        man.extra_payment,
        man.low_internet,
        man.inattentive_students,
        man.discomfort_in_online_class,
        (man.device_access + man.internet_access + man.no_internet_access + man.extra_payment + man.low_internet + man.inattentive_students + discomfort_in_online_class + man.other) AS total
    FROM
        (SELECT
            SUM(tbl.teacher_hurdle_electronic_device_access = 1) AS device_access,
                SUM(tbl.teacher_hurdle_internet_access = 1) AS internet_access,
                SUM(tbl.teacher_hurdle_internet_access = 0) AS no_internet_access,
                SUM(tbl.teacher_hurdle_no_extra_payment = 1) AS extra_payment,
                SUM(tbl.teacher_hurdle_low_internet = 1) AS low_internet,
                SUM(tbl.teacher_hurdle_inattentive_students = 1) AS inattentive_students,
                SUM(tbl.teacher_hurdle_discomfort_in_online_class = 1) AS discomfort_in_online_class,
                SUM(tbl.teacher_hurdle_other = 1) AS other
        FROM
            education_covid19_impact AS tbl) AS man");


        $data = collect($data)->map(function ($data) {
            return [
                ["category" => "Proper electronic device access", "column-1" => number_format($data->device_access * (100 / $data->total), 2)],
                ["category" => "No access to internet", "column-1" => number_format($data->no_internet_access * (100 / $data->total), 2)],
                ["category" => "Poor internet facility", "column-1" => number_format($data->low_internet * (100 / $data->total), 2)],
                ["category" => "No Extra payment", "column-1" => number_format($data->extra_payment * (100 / $data->total), 2)],
                ["category" => "Loss of interaction between teacher and student", "column-1" => number_format($data->inattentive_students * (100 / $data->total), 2)],
                ["category" => "Discomfort in online class", "column-1" => number_format($data->discomfort_in_online_class * (100 / $data->total), 2)]
            ];
        })->toArray()[0];;

        return [
            'chart' => [
                'type' => 'bar'
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('category'),
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Upazila',
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
                'pointFormat' => '{series.name} : {point.y:,.2f}%',
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
                        'format' => '{point.y:,.2f}%'
                    ]
                ],
                'series' => [
                    'dataLabels'=> [
                        'enabled'=> true,
                        'style'=>[
                            'textShadow'=>false,
                            'strokeWidth'=>0,
                            'textOutline'=>false
                        ]
                    ],
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'enabled' => false
            ],
            'series' => [
                [
                    'name' => '',
                    'color' => "#83C341",
                    'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                        return round($value, 2);
                    }),
                ]
            ]
        ];
    }
}
