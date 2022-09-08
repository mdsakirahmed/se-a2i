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
    public function filter_by_hr($value)
    {
        $this->hr = $value;
        $this->chart_update();
    }

    public function filter_by_id_poor($value)
    {
        $this->id_poor = $value;
        $this->chart_update();
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $fiscal_year, $program_type, $implementing_ministry_1, $implementing_ministry_2;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
            year, region, mpi, hr, id_poor, vul_pov
            FROM
            corona_socio_info.ophi_poverty;");


        // $this->hr = collect($data)->pluck('hr')->unique();
        // $this->id_poor = collect($data)->pluck('id_poor')->unique();
        // $this->vul_pov = collect($data)->pluck('vul_pov')->unique();
        // $this->mpi = collect($data)->pluck('mpi')->unique();

        // if ($this->hr) {
        //     $data = collect($data)->where('hr', $this->hr);
        // }

        // if ($this->id_poor) {
        //     $data = collect($data)->where('id_poor', $this->id_poor);
        // }

        // if ($this->vul_pov) {
        //     $data = collect($data)->where('vul_pov', $this->vul_pov);
        // }

        // if ($this->mpi) {
        //     $data = collect($data)->where('mpi', $this->mpi);
        // }


        $poverty_index_ophi_data_set['region'] =
        $poverty_index_ophi_data_set['mpi'] =
        $poverty_index_ophi_data_set['hr'] =
        $poverty_index_ophi_data_set['id_poor'] =
        $poverty_index_ophi_data_set['vul_pov'] =
        array();
        foreach (collect($data) as $data_of_a_year) {
            array_push($poverty_index_ophi_data_set['region'],$data_of_a_year->region);
            array_push($poverty_index_ophi_data_set['mpi'],(float) $data_of_a_year->mpi);
            array_push($poverty_index_ophi_data_set['hr'],(float) $data_of_a_year->hr);
            array_push($poverty_index_ophi_data_set['id_poor'],(float) $data_of_a_year->id_poor);
            array_push($poverty_index_ophi_data_set['vul_pov'],(float) $data_of_a_year->vul_pov);
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
                'categories' => $poverty_index_ophi_data_set['region'],
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
                'enabled'=>true,
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
            
            'series' => [[
                'name' => 'Headcount ratio: Population in multidimensional poverty',
                'color' => "#83C341",
                'data' =>  $poverty_index_ophi_data_set['hr']
            ],
            [
                'name' => 'Headcount ratio: Population in multidimensional poverty',
                'color' => "#7F3F98",
                'data' =>  $poverty_index_ophi_data_set['ind_poor']
            ],
            [
                'name' => 'Headcount ratio: Population in multidimensional poverty',
                'color' => "#FFB207",
                'data' =>  $poverty_index_ophi_data_set['vul_pov']
            ],
            [
                'name' => 'Headcount ratio: Population in multidimensional poverty',
                'color' => "#83C341",
                'data' =>  $poverty_index_ophi_data_set['mpi']
            ]
            ]
        ];
    }
}
