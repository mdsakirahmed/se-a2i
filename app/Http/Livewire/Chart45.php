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

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $poverties = [
        'Headcount ratio: Population in multidimensional poverty', 'Intensity of Deprivation among Poor', 'Vulnerable to Poverty', 'Multidimensional Poverty Index'
    ];
    public $selected_poverty;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT year, region, mpi, hr, id_poor, vul_pov FROM corona_socio_info.ophi_poverty;");

        $categories = collect($data)->pluck('region')->unique();

        $formated_data = [];
        switch ($this->selected_poverty) {
            case 'Headcount ratio: Population in multidimensional poverty':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#83C341",
                    'data' =>  collect($data)->pluck('hr')
                ]);
                break;
            case 'Intensity of Deprivation among Poor':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#7F3F98",
                    'data' =>  collect($data)->pluck('id_poor')
                ]);
                break;
            case 'Vulnerable to Poverty':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#FFB207",
                    'data' =>  collect($data)->pluck('vul_pov')
                ]);
                break;
            case 'Multidimensional Poverty Index':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#EE47B5",
                    'data' =>  collect($data)->pluck('mpi')
                ]);
                break;
            default:
                array_push($formated_data, [
                    'name' => "Headcount ratio: Population in multidimensional poverty",
                    'color' => "#83C341",
                    'data' =>  collect($data)->pluck('hr')
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
                'categories' => $categories,
                'crosshair' => true,
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
                    'text' => 'Percentage',
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

            'legend' => [
                'enabled' => true,
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin' => 45
            ],

            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '<b>{point.key}</b><br>',
                'pointFormat' => '{series.name} : {point.y:,.2f}',
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
                    'pointPadding' => 0.2,
                    'borderWidth' => 0
                ],
                'series' => [
                    'borderRadius' => '5px',
                ]
            ],

            'series' => $formated_data

            // 'series' => [
            //     [
            //         'name' => 'Headcount ratio: Population in multidimensional poverty',
            //         'color' => "#83C341",
            //         'data' =>  $poverty_index_ophi_data_set['hr']
            //     ],
            //     [
            //         'name' => 'Headcount ratio: Population in multidimensional poverty',
            //         'color' => "#7F3F98",
            //         'data' =>  $poverty_index_ophi_data_set['mpi']
            //     ],
            //     [
            //         'name' => 'Headcount ratio: Population in multidimensional poverty',
            //         'color' => "#FFB207",
            //         'data' =>  $poverty_index_ophi_data_set['vul_pov']
            //     ],
            //     [
            //         'name' => 'Headcount ratio: Population in multidimensional poverty',
            //         'color' => "#83C341",
            //         'data' =>  $poverty_index_ophi_data_set['mpi']
            //     ]
            // ]
        ];
    }
}
