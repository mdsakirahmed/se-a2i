<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart46 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 46;

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

        return view('livewire.chart46', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $poverties = [
        'Number of poor at $1.90 a day (2011 PPP) in millions', 
        'Gini Index', 
        'Income Held by Highest 10%', 
        'Poverty Gap at $1.90 a day (2011 PPP) in percentage',
        'Poverty headcount ratio at $1.90 a day (2011 PPP) in % population'
    ];
    public $selected_poverty;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT year,gini,income_10,poor,gap,poverty_hr FROM corona_socio_info.wb_poverty_indicator;");

        $categories = collect($data)->pluck('year')->unique();

        $formated_data = [];
        switch ($this->selected_poverty) {
            case 'Number of poor at $1.90 a day (2011 PPP) in millions':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#83C341",
                    'data' =>  collect($data)->pluck('poor')
                ]);
                break;
            case 'Gini Index':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#7F3F98",
                    'data' =>  collect($data)->pluck('gini')
                ]);
                break;
            case 'Income Held by Highest 10%':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#FFB207",
                    'data' =>  collect($data)->pluck('income_10')
                ]);
                break;
            case 'Poverty Gap at $1.90 a day (2011 PPP) in percentage':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#EE47B5",
                    'data' =>  collect($data)->pluck('gap')
                ]);
                break;
            case 'Poverty headcount ratio at $1.90 a day (2011 PPP) in % population':
                array_push($formated_data, [
                    'name' => "$this->selected_poverty",
                    'color' => "#7F3F98",
                    'data' =>  collect($data)->pluck('poverty_hr')
                ]);
                break;

            default:
                array_push($formated_data, [
                    'name' => "Number of poor at $1.90 a day (2011 PPP) in millions",
                    'color' => "#83C341",
                    'data' =>  collect($data)->pluck('poor')
                ]);
        }



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
                'categories' => $categories,
                'crosshair' => true,
                'title' => [
                    'text' => 'Year',
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
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,               
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
                    'borderWidth' => 0,
                    'dataLabels' => [
                        'enabled' => true,
                        'inside' => false,
                        'format' => "{point.y:,.2f}",
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

            'series' => $formated_data
        ];
    }
}
