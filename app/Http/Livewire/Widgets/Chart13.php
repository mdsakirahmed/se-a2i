<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart13 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 13;

    public function render()
    {
        $this->chart = Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('widgets.chart13', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        year,
        MAX(CASE
        WHEN `workers_category` = 'Professional' THEN number_of_employment
        END) Professional,
        MAX(CASE
        WHEN `workers_category` = 'Less-skilled' THEN number_of_employment
        END) Less,
        MAX(CASE
        WHEN `workers_category` = 'Semi-skilled' THEN number_of_employment
        END) Semi,
        MAX(CASE
        WHEN `workers_category` = 'Skilled' THEN number_of_employment
        END) Skilled,
        MAX(CASE
        WHEN `workers_category` = 'Others' THEN number_of_employment
        ELSE 0
        END) Others
        FROM
        economy_employment_overseas_categorywise
        WHERE
        year IS NOT NULL
        GROUP BY year");

        $economy_employment_overseas_category_wise['year'] =
        $economy_employment_overseas_category_wise['Professional'] =
        $economy_employment_overseas_category_wise['Less'] =
        $economy_employment_overseas_category_wise['Semi'] =
        $economy_employment_overseas_category_wise['Skilled'] =
        $economy_employment_overseas_category_wise['Others'] =
        array();
        foreach(collect($data) as $data_of_a_year){
            if((int)$data_of_a_year->year >= 1990){
            array_push($economy_employment_overseas_category_wise['year'], (int)$data_of_a_year->year);
            array_push($economy_employment_overseas_category_wise['Professional'], (float) $data_of_a_year->Professional);
            array_push($economy_employment_overseas_category_wise['Less'], (float) $data_of_a_year->Less);
            array_push($economy_employment_overseas_category_wise['Semi'], (float) $data_of_a_year->Semi);
            array_push($economy_employment_overseas_category_wise['Skilled'], (float)$data_of_a_year->Skilled);
            array_push($economy_employment_overseas_category_wise['Others'], (float)$data_of_a_year->Others);
            }
        }

        return [
            'chart' => [
                'type' => 'spline',
                'zoomType' => 'xy'
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
                'categories' => $economy_employment_overseas_category_wise['year'],
                'accessibility' => [
                    'rangeDescription' => ''
                ]
            ],

            'yAxis' => [
                'title' => [
                    'text' => 'Number of overseas employment (in thousand)'
                ]
            ],
            'legend' => [
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle'
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
                'pointFormat' => '{series.name} : {point.y}%',
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
                'name' => 'Professional',
                'color' => "#7F3F98",
                'data' =>   $economy_employment_overseas_category_wise['Professional'],
            ], [
                'name' => 'Less',
                'color' => "#83C341",
                'data' =>  $economy_employment_overseas_category_wise['Less'],
            ],[
            ], [
                'name' => 'Semi',
                'color' => "#16507B",
                'data' =>  $economy_employment_overseas_category_wise['Semi'],
            ],[
            ], [
                'name' => 'Skilled',
                'color' => "#FF6361",
                'data' =>  $economy_employment_overseas_category_wise['Skilled'],
            ],[
                'name' => 'Others',
                'color' => "#FFA600",
                'data' =>  $economy_employment_overseas_category_wise['Others'],
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
                        ]
                    ]
                ]]
            ]
        ];
    }
}
