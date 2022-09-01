<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart29 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 29;

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

        return view('livewire.chart29', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        CONCAT(SUBSTRING(month, 1, 3), '-', SUBSTRING(year, 3,2)) AS date,
        ROUND(number_of_transactions_internet_banking_in_crore, 1) AS banking,
        ROUND(number_of_transactions_mobile_banking_in_crore, 1) AS mobile,
        ROUND(number_of_transactions_agent_banking_in_crore, 1) AS agent
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
                'categories' =>  collect($data)->pluck('date')
            ], 'yAxis' =>  [
                'title' =>  [
                    'text' =>  'Number of transactions (In million)'
                ], 'labels' =>  [
                    'format' =>  '{value}'
                ]
            ],
            'legend' => [
                'reversed' => true
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0
            ],
            'plotOptions' =>  [
                'bar'=> [
                    'stacking'=> 'normal',
                    'pointPadding'=> 0,
                    'groupPadding'=> 0,
                    'dataLabels'=> [
                        'enabled'=> true,
                        'color'=> '#FFFFFF'
                    ]
                ]
            ], 
            'series' =>  [
                [
                    'name' =>  'Internet Banking',
                    'data' =>  collect($data)->pluck('banking')->map(function ($value) {
                        return round($value / 1000000, 2);
                    }),
                    'color' =>  '#83C341',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ]
                , [
                    'name' =>  'Agent',
                    'data' =>  collect($data)->pluck('agent')->map(function ($value) {
                        return round($value / 1000000, 2);
                    }),
                    'color' =>  '#FFB207',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ],
                [
                    'name' =>  'Mobile',
                    'data' =>  collect($data)->pluck('mobile')->map(function ($value) {
                        return round($value / 1000000, 2);
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
