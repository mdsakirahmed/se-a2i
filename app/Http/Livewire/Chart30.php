<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart30 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 30;

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

        return view('livewire.chart30', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        CONCAT(SUBSTRING(month, 1, 3), '-', SUBSTRING(year, 3,2)) AS date,
        ROUND(amount_of_transactions_urban_in_crore_bdt, 1) AS urban,
        ROUND(amount_of_transactions_rural_in_crore_bdt, 1)  AS rural
        FROM
        corona_socio_info.economy_banking");

        $data = array_reverse($data);

        return [
            'chart' =>  [
                'type' =>  'bar', 'zoomType' => 'xy'
            ], 'title' =>  [
                'text' =>  ''
            ], 'credits' =>  [
                'enabled' =>  false
            ], 'subtitle' =>  [
                'text' =>  ''
            ]
            // ,'marker' =>  [
            //     'radius' =>  5
            // ]
            , 'xAxis' =>  [
                'categories' =>  collect($data)->pluck('date'),
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ], 'yAxis' =>  [
                'title' =>  [
                    'text' =>  'Volume of transactions (In thousand crore BDT)',
                    'style'=>[
                        'fontSize'=>'15px'
                    ]  
                ],
                'labels'=>[
                    'format' =>  '{value}',
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'legend' => [
                'reversed' => true
            ],
            'legend' => [
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin'=> 45
            ],
            'plotOptions' =>  [
                'bar'=> [
                    'stacking'=> 'normal',
                    'pointMargin'=> 10,
                    'groupMargin'=> 0,
                    'enableMouseTracking' =>  true,
                    'dataLabels'=> [
                        'enabled'=> false,
                        
                    ],
                    'pointWidth'=>10
                ],
            ], 
            'series' =>  [
                [
                    'name' =>  'Rural',
                    'data' =>  collect($data)->pluck('rural')->map(function ($value) {
                        return round($value / 1000, 2);
                    }),
                    'color' =>  '#83C341',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ],
                [
                    'name' =>  'Urban',
                    'data' =>  collect($data)->pluck('urban')->map(function ($value) {
                        return round($value / 1000, 2);
                    }),
                    'color' =>  '#7F3F98',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ]

            ]
        ];
    }
}
