<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart14 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 14;

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

        return view('livewire.chart14', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        fiscal_year,
        MAX(CASE
            WHEN `inflation_type` = 'General-point to point' THEN inflation
            END) GeneralPointToPoint,
        MAX(CASE
            WHEN `inflation_type` = 'Food-point to point' THEN inflation
            END) FoodPointToPoint,
        MAX(CASE
            WHEN `inflation_type` = 'Non food-point to point' THEN inflation
            END) NonFoodPointToPoint
        FROM
            economy_national_inflation
        WHERE
            fiscal_year IS NOT NULL
        GROUP BY fiscal_year");

        $categories = $series =
        $GeneralPointToPoint =
        $FoodPointToPoint =
        $NonFoodPointToPoint = [];
        foreach(collect($data) as $data){
            array_push($categories, substr($data->fiscal_year, 0, 5).substr($data->fiscal_year, 7, 10));
            array_push($GeneralPointToPoint, (float)$data->GeneralPointToPoint);
            array_push($FoodPointToPoint, (float)$data->FoodPointToPoint);
            array_push($NonFoodPointToPoint, (float)$data->NonFoodPointToPoint);
        }

        $series=[
            [
                'name' => 'Overall (Change in CPI)',
                'data' => $GeneralPointToPoint,
                'marker'=> [
                    'radius'=>3
                ]
                
            ],
            [
                'name' => 'Food Inflation',
                'data' => $FoodPointToPoint,
                'marker'=> [
                    'radius'=>3
                ]
            ],
            [
                'name' => 'Non-food Inflation',
                'data' => $NonFoodPointToPoint,
                'marker'=> [
                    'radius'=>3
                ]
            ]
        ];

        return [
            'chart' => [
                'type' => 'spline',
                'zoomType' => 'xy'
            ],

            'credits' => [
                'enabled'=>false
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
                'categories' => $categories,
                'accessibility' => [
                    'rangeDescription' => ''
                ]
            ],

            'yAxis' => [
                'title' => [
                    'text' => 'Inflation Rate (%)'
                ]
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0
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
            'colors'=> ['#7F3F98', '#83C341', '#FFB207'],
            'series' => $series,

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
