<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart4 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 4;

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

        return view('livewire.chart4', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        man.device_access,
        man.internet_access,
        man.no_internet_access,
        man.affordable_internet,
        man.low_internet,
        man.loss_of_interactivity,
        man.difficulty_to_understand,
        man.boredom_in_online_class,
        (man.device_access + man.internet_access + man.no_internet_access + man.affordable_internet + man.low_internet + man.loss_of_interactivity + difficulty_to_understand + man.boredom_in_online_class) AS total
    FROM
        (SELECT
            SUM(tbl.student_hurdle_electronic_device_access = 1) AS device_access,
                SUM(tbl.student_hurdle_internet_access = 1) AS internet_access,
                SUM(tbl.student_hurdle_internet_access = 0) AS no_internet_access,
                SUM(tbl.student_hurdle_affordable_internet = 1) AS affordable_internet,
                SUM(tbl.student_hurdle_low_internet = 1) AS low_internet,
                SUM(tbl.student_hurdle_loss_of_interactivity = 1) AS loss_of_interactivity,
                SUM(tbl.student_hurdle_difficulty_to_understand = 1) AS difficulty_to_understand,
                SUM(tbl.student_hurdle_boredom_in_online_class = 1) AS boredom_in_online_class
        FROM
            education_covid19_impact AS tbl) AS man");

        $data = collect($data)->map(function ($data) {
            return [
                ["category" => "Proper electronic device access", "column-1" => number_format($data->device_access * (100 / $data->total), 2)],
                ["category" => "No access to internet", "column-1" => number_format($data->no_internet_access * (100 / $data->total), 2)],
                ["category" => "Poor internet facility", "column-1" => number_format($data->low_internet * (100 / $data->total), 2)],
                ["category" => "Affordable internet", "column-1" => number_format($data->affordable_internet * (100 / $data->total), 2)],
                // ["category" => "Loss of interaction between teacher and student", "column-1" => $data->affordable_internet],
                ["category" => "Difficulty to understand online class", "column-1" => number_format($data->difficulty_to_understand * (100 / $data->total), 2)],
                ["category" => "Boredom in online class", "column-1" => number_format($data->boredom_in_online_class * (100 / $data->total), 2)]
            ];
        })->toArray()[0];

        // dd($data);

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
                        'format' => '{point.y:,.2f}%'
                    ]
                ],
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'inside' => false,
                        'color' => '#000000',
                        'style' => [
                            'textShadow' => false,
                            'strokeWidth' => 0,
                            'textOutline' => false
                        ]
                    ],
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'enabled' => false,
            ],
            'series' => [
                [
                    'name' => '',
                    'color' => "#722A8D",
                    'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                        return round($value, 2);
                    }),
                ]
            ]
        ];
    }
}
