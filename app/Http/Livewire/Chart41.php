<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart41 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 41;
    public $chart_type = 'column';
    public $f_year, $f_years, $complete_data_set;
    public $imp_min, $imp_mins;
    public $imp_2_min, $imp_2_mins;
    public $p_type, $p_types;

    public $x_min, $x_max, $y_min, $y_max;

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

        return view('livewire.chart41', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function change_chart_type($chart_type)
    {
        $this->chart_type = $chart_type;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        fiscal_year,
        programme_type,
        programme_name,
        implementing_ministry_1,
        implementing_ministry_2,
        budget_crore_bdt,
        beneficiaries_lac_persons
        FROM ssn_budget_coverage");


        $this->f_years = collect($data)->unique('fiscal_year')->pluck('fiscal_year');
        $this->imp_mins = collect($data)->unique('implementing_ministry_1')->pluck('implementing_ministry_1');
        $this->imp_2_mins = collect($data)->unique('implementing_ministry_2')->pluck('implementing_ministry_2');
        $this->p_types = collect($data)->unique('programme_type')->pluck('programme_type');
        
        if($this->x_min){
            $data = collect($data)->where('beneficiaries_lac_persons', '>', $this->x_min);
        }
        if($this->x_max){
            $data = collect($data)->where('beneficiaries_lac_persons', '<', $this->x_max);
        }
        if($this->y_min){
            $data = collect($data)->where('budget_crore_bdt', '>', $this->y_min);
        }
        if($this->y_max){
            $data = collect($data)->where('budget_crore_bdt', '<', $this->y_max);
        }



        if ($this->f_year) {
            $data = collect($data)->where('fiscal_year', $this->f_year);
        }

        if ($this->imp_min) {
            $data = collect($data)->where('implementing_ministry_1', $this->imp_min);
        }

        if ($this->imp_2_min) {
            $data = collect($data)->where('implementing_ministry_2', $this->imp_2_min);
        }

        if ($this->p_type) {
            $data = collect($data)->where('programme_type', $this->p_type);
        }


        $data_collection = [];
        foreach (collect($data)->groupBy('programme_type') as $programme_type => $data_set) {
            $value_set = [];
            foreach ($data_set as $pointed_value) {
                array_push($value_set, [
                    'x' => $pointed_value->budget_crore_bdt,
                    'y' => $pointed_value->beneficiaries_lac_persons,
                    'programme_name' => $pointed_value->programme_name,
                    'implementing_ministry_1' => $pointed_value->implementing_ministry_1,
                    'implementing_ministry_2' => [
                        'title' => $pointed_value->implementing_ministry_2 ? 'Implementing Ministry 2:' : "",
                        'value' => $pointed_value->implementing_ministry_2
                    ]
                ]);
            }

            array_push($data_collection, [
                'name' => $programme_type,
                'data' => $value_set,
            ]);
        }

        return [
            'chart' => [
                'type' => 'scatter',
                'zoomType' => 'xy'
            ],
            'title' => [
                'text' => ''
            ],
            'subtitle' => [
                'text' => ''
            ], 'credits' => [
                'enabled' => false
            ],
            'legend' => [
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin' => 45
            ],
            'xAxis' => [
                'title' => [
                    'enabled' => true,
                    'text' => 'Budget (Crore BDT)',
                    'style' => [
                        'fontSize' => '15px'
                    ]
                ],
                'labels' => [
                    'format' => '{value}',
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ],
                'startOnTick' => true,
                'endOnTick' => true,
                'showLastLabel' => true
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Coverage (Lakh People)',
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

            'plotOptions' => [
                'series' => [
                    'events' => [
                        'legendItemClick' => 'function(){
                        if (!this.visible)
                        return true;
                    
                    var seriesIndex = this.index;
                    var series = this.chart.series;
                    
                    for (var i = 0; i < series.length; i++)
                    {
                        if (series[i].index != seriesIndex)
                        {
                            
                            series[i].visible ? series[i].hide() : series[i].show();
                        } 
                    }
                    
                    return false;
                    }'
                    ]
                ],

                'scatter' => [
                    'marker' => [
                        'symbol' => 'circle',
                        'radius' => 4,
                        'states' => [
                            'hover' => [
                                'enabled' => true,
                                'lineColor' => 'rgb(100,100,100)'
                            ]
                        ]
                    ],
                    'states' => [
                        'hover' => [
                            'marker' => [
                                'enabled' => false
                            ]
                        ]
                    ],
                    'tooltip' => [
                        'headerFormat' => '<b>Programme Type:</b> {series.name}<br>',
                        'pointFormat' => '<b>Programme Name:</b> {point.programme_name}<br><b>Budget Crore BDT:</b> {point.x}<br><b>Beneficiaries Lac Person:</b> {point.y}<br><b>Implementing Ministry 1:</b> {point.implementing_ministry_1}<br><b>{point.implementing_ministry_2.title}</b> {point.implementing_ministry_2.value}',
                    ]
                ]
            ],
            'series' => $data_collection,
            'colors' => ['#630000', '#A12568', '#FF5403', '#38A3A5', '#1A5F7A', '#D22779', '#DA1212', '#3E7C17', '#FFBD35']
        ];
    }
}
