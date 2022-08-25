<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart18 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 18;

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

        return view('livewire.chart18', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        CONCAT(a.year, '-', a.year+1) as year, a.number_of_employment, b.remittance_in_million_usd
        FROM
        (SELECT 
            year, SUM(number_of_employment) AS number_of_employment
        FROM
            corona_socio_info.economy_employment_overseas_countrywise where year between '2000' and '2020'
        GROUP BY year
        ORDER BY year ASC) AS a
            LEFT JOIN
        corona_socio_info.economy_remittance_yearly b ON a.year = b.year
        ORDER BY a.year DESC");;
        $data = collect($data)->map(function ($data) {
            return [
                "category" => substr($data->year, 0, 5).substr($data->year, 7, 10), "column-2" => round($data->number_of_employment / 1000,2), "column-1" => round($data->remittance_in_million_usd / 1000, 2)
            ];
        })->toArray();

        $data = array_reverse($data);

        return [
            'chart' => [
                'type' => 'column',
                'zoomType' => 'xy'
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('category')
            ],
            'yAxis' => [[
                'labels' => [
                    'format' => '{value}'
                ],
                'title' => [
                    'text' => 'Remittance (In thousand million US$)'
                ]
            ], [
                'title' => [
                    'text' => 'Total Employment (In Thousand)'
                ],
                'labels' => [
                    'format' => '{value}'
                ],
                'opposite' => true
            ]],
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
                        'enabled' => false,
                    ]
                ]
            ],
            'legend' => [
                'enabled' => true
            ],
            'series' => [[
                'name' => 'Total Employment (In Thousand)',
                'stack' => '',
                'color' => "#83C341",
                'yAxis' => 1,
                'data' =>  collect($data)->pluck('column-2')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'color' => "#7F3F98",
                'name' => 'Remittance (In thousand million US$)',
                'type' => 'spline',
                'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                    return round($value, 2);
                }),

            ],
]
        ];
    }
}
