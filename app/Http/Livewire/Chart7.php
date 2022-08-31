<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart7 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 7;

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

        return view('livewire.chart7', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        urban.u_year, urban.u_percentage, rural.r_percentage
    FROM
        (SELECT 
            u_ti.year AS u_year,
                ((COALESCE(u_tci.u_total_connc_ins, 0) * 100) / u_ti.u_total_ins) AS u_percentage
        FROM
            (SELECT 
            COUNT(institution_name) AS u_total_ins, year
        FROM
            corona_socio_info.education_statistics
        WHERE
            year IS NOT NULL AND area != 'RURAL'
        GROUP BY year) AS u_ti
        LEFT JOIN (SELECT 
            COUNT(institution_name) AS u_total_connc_ins, year
        FROM
            corona_socio_info.education_statistics
        WHERE
        internet_connection = 1 AND area != 'RURAL'
        GROUP BY year) AS u_tci ON u_ti.year = u_tci.year) AS urban
            LEFT JOIN
        (SELECT 
            r_ti.year AS r_year,
                ((COALESCE(r_tci.r_total_connc_ins, 0) * 100) / r_ti.r_total_ins) AS r_percentage
        FROM
            (SELECT 
            COUNT(institution_name) AS r_total_ins, year
        FROM
            corona_socio_info.education_statistics
        WHERE
            year IS NOT NULL AND area = 'RURAL'
        GROUP BY year) AS r_ti
        LEFT JOIN (SELECT 
            COUNT(institution_name) AS r_total_connc_ins, year
        FROM
            corona_socio_info.education_statistics
        WHERE
        internet_connection = 1 AND area = 'RURAL'
        GROUP BY year) AS r_tci ON r_ti.year = r_tci.year) AS rural ON rural.r_year = urban.u_year");


        $data = collect($data)->map(function ($data) {
            return [
                "category" => $data->u_year, "column-1" => number_format($data->u_percentage, 0), "column-2" => number_format($data->r_percentage, 0)
            ];
        })->toArray();

        return [
            'chart' => [
                'type' => 'spline'
            ],

            'legend' => [
                'symbolWidth' => 80
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

            'yAxis' => [
                'title' => [
                    'text' => 'Percentage of School'
                ]
            ],

            'xAxis' => [
                'accessibility' => [
                    'rangeDescription' => ''
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
                        'format' => '{point.y}%'
                    ],
                    'pointStart' => 2014
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
                'name' => 'Urban',
                'color' => "#7F3F98",
                'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'name' => 'Rural',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('column-2')->map(function ($value) {
                    return round($value, 2);
                }),
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
