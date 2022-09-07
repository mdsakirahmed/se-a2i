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
                'name' => 'Intensity of Deprivation among Poor',
                'color' => "#83C341",
                'data' =>  $poverty_index_ophi_data_set['id_poor']
            ],[
                'name' => 'Headcount ratio: Population in multidimensional poverty',
                'color' => "#7F3F98",
                'data' =>  $poverty_index_ophi_data_set['hr']
            ],[
                'name' => 'Vulnerable to Poverty',
                'color' => "#ee47b5",
                'data' =>  $poverty_index_ophi_data_set['vul_pov']
            ],[
                'name' => 'Multidimensional Poverty Index',
                'color' => "#FFB207",
                'data' =>  $poverty_index_ophi_data_set['mpi']
            ]]
        ];
    }
}
