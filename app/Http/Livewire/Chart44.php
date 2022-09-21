<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart44 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 44;

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
        
       
        return view('livewire.chart44', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        year, poverty_pct_pop, extreme_pov_pct_pop
        FROM
        corona_socio_info.bbs_poverty;");       

        $poverty_rate_bbs_data_set['year'] =
        $poverty_rate_bbs_data_set['poverty_pct_pop'] =
        $poverty_rate_bbs_data_set['extreme_pov_pct_pop'] =
        array();
        foreach (collect($data) as $data_of_a_year) {
            array_push($poverty_rate_bbs_data_set['year'],$data_of_a_year->year);
            array_push($poverty_rate_bbs_data_set['poverty_pct_pop'],(float) $data_of_a_year->poverty_pct_pop);
            array_push($poverty_rate_bbs_data_set['extreme_pov_pct_pop'],(float) $data_of_a_year->extreme_pov_pct_pop);
        }

        // dd($poverty_rate_bbs_data_set);

        return [
            'chart' => [
                'type' => 'spline',
                'zoomType' => 'xy'
            ],

            'credits' => [
                'enabled' => false
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
                'categories' => $poverty_rate_bbs_data_set['year'],
                'accessibility' => [
                    'rangeDescription' => ''
                ],
                'labels' => [
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],

            'yAxis' => [
                'title' => [
                    'text' => 'Percentage',
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
            'legend' => [
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin' => 45
            ],

            'plotOptions' => [
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => '{point.y}%',
                        'color'=> '#323232'
                    ],
                ]
            ],

            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '<b>{point.key}</b><br>',
                'pointFormat' => '{series.name} : {point.y}',
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
                'name' => 'Poverty (% Population)',
                'color' => "#7F3F98",
                'data' =>   $poverty_rate_bbs_data_set['poverty_pct_pop']
            ], [
                'name' => 'Extreme Poverty (% Population)',
                'color' => "#83C341",
                'data' =>  $poverty_rate_bbs_data_set['extreme_pov_pct_pop'],
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
