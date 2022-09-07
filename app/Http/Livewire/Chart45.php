<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart45 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 45;

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

        return view('livewire.chart45', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        year, region, mpi, hr, id_poor, vul_pov
        FROM
        corona_socio_info.ophi_poverty;");

        $formated_data = array();
        foreach ($data as $key => $value) {
            array_push($formated_data, [
                'location'  => $key,
                'hr' => round($value->where('early_marriage', 'Increased')->sum('event_percent'), 2),
                'decreased' => round($value->where('early_marriage', 'Decreased')->sum('event_percent'), 2),
                'same'      => round($value->where('early_marriage', 'Same')->sum('event_percent'), 2),
            ]);
        }

        return [
            'chart' => [
                'type' => 'column'
            ],

            'credits' => [
                'enabled' => false
            ],

            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('students_participation_percentage'),
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
                        'fontSize' => '15px'
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
                        'inside' => false,
                        'format' => "{point.y:,.2f}" . '%',
                        'color'=> '#323232'
                    ]
                ],
                'series' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'style' => [
                            'textShadow' => false,
                            'strokeWidth' => 0,
                            'textOutline' => false
                        ]
                    ],
                    'pointWidth' => 30,
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'enabled' => false
            ],
            'series' => [[
                'name' => '',
                'stack' => '',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('raite_of_students_participation_percentage')->map(function ($value) {
                    return round($value, 2);
                }),
            ]]
        ];
    }
}
