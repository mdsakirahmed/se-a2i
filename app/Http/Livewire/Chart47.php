<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart47 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 47;

    public function render()
    {
        $this->chart =Chart::findOrFail($this->chart_id);
        if(app()->currentLocale() == 'bn'){
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        }else{
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart47', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        year,
        region,

        poverty_gap_national_lower,
        poverty_gap_national_upper,
        poverty_gap_rural_lower,
        poverty_gap_rural_upper,

        poverty_gap_urban_lower,
        poverty_gap_urban_upper,
        squared_poverty_gap_national_lower,
        squared_poverty_gap_national_upper,

        squared_poverty_gap_rural_lower,
        squared_poverty_gap_rural_upper,
        squared_poverty_gap_urban_lower,
        squared_poverty_gap_urban_upper
        FROM
        corona_socio_info.bbs_poverty_and_sqd_poverty;");

        $poverty_squared_poverty_gap_data_set['region'] =
        $poverty_squared_poverty_gap_data_set['year'] =
        $poverty_squared_poverty_gap_data_set['poverty_gap_national_lower'] =
        $poverty_squared_poverty_gap_data_set['poverty_gap_national_upper'] =
        $poverty_squared_poverty_gap_data_set['poverty_gap_rural_lower'] =

        $poverty_squared_poverty_gap_data_set['poverty_gap_rural_upper'] =
        $poverty_squared_poverty_gap_data_set['poverty_gap_urban_lower'] =
        $poverty_squared_poverty_gap_data_set['poverty_gap_urban_upper'] =
        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_national_lower'] =
        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_national_upper'] =

        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_rural_lower'] =
        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_rural_upper'] =
        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_urban_lower'] =
        $poverty_squared_poverty_gap_data_set['squared_poverty_gap_urban_upper'] =


        array();
        foreach (collect($data) as $data_of_a_year) {
            array_push($poverty_squared_poverty_gap_data_set['region'],$data_of_a_year->region);
            array_push($poverty_squared_poverty_gap_data_set['year'], $data_of_a_year->year);
            array_push($poverty_squared_poverty_gap_data_set['hr'],(float) $data_of_a_year->hr);
            array_push($poverty_squared_poverty_gap_data_set['id_poor'],(float) $data_of_a_year->id_poor);
            array_push($poverty_squared_poverty_gap_data_set['vul_pov'],(float) $data_of_a_year->vul_pov);

            array_push($poverty_squared_poverty_gap_data_set['region'],$data_of_a_year->region);
            array_push($poverty_squared_poverty_gap_data_set['mpi'],(float) $data_of_a_year->mpi);
            array_push($poverty_squared_poverty_gap_data_set['hr'],(float) $data_of_a_year->hr);
            array_push($poverty_squared_poverty_gap_data_set['id_poor'],(float) $data_of_a_year->id_poor);
            array_push($poverty_squared_poverty_gap_data_set['vul_pov'],(float) $data_of_a_year->vul_pov);

            array_push($poverty_squared_poverty_gap_data_set['region'],$data_of_a_year->region);
            array_push($poverty_squared_poverty_gap_data_set['mpi'],(float) $data_of_a_year->mpi);
            array_push($poverty_squared_poverty_gap_data_set['hr'],(float) $data_of_a_year->hr);
            array_push($poverty_squared_poverty_gap_data_set['id_poor'],(float) $data_of_a_year->id_poor);
            array_push($poverty_squared_poverty_gap_data_set['vul_pov'],(float) $data_of_a_year->vul_pov);
        }

        return [
            'chart' => [
                'type' => 'column'
            ],
            
            'credits' => [
                'enabled'=>false
            ],

            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => $poverty_squared_poverty_gap_data_set['region'],
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,
                'title' => [
                    'text' => 'Count medals',
                    'style'=>[
                        'fontSize'=>'14px'
                    ]
                ],
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0
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
                        'format' => '{point.series.name}'

                    ]
                ],
                'series' => [
                    'dataLabels'=> [
                        'enabled'=> true,
                        'rotation'=> 270,
                        'style'=>[
                            'textShadow'=>false,
                            'strokeWidth'=>0,
                            'textOutline'=>false
                        ]
                    ],
                    'pointWidth'=> 30,
                    'borderRadius' => '10px',
                ]
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0,
                'margin'=> 45
            ],
            'series' => [[
                'name'=> 'National-10',
                'data'=> [148, 133, 124],
                'color'=>'#83C341',
                'stack'=> '2010'
              ], [
                'name'=> 'Rural-10',
                'color'=>'#7F3F98',
                'data'=> [102, 98, 65],
                'stack'=> '2010'
              ], [
                'name'=> 'Urban-10',
                'color'=>'#FFB207',
                'data'=> [102, 98, 65],
                'stack'=> '2010'
              ], [
                'name'=> 'National-16',
                'data'=> [113, 122, 95],
                'color'=>'#83C341',
                'stack'=> '2016'
              ], [
                'name'=> 'Rural-16',
                'color'=>'#7F3F98',
                'data'=> [113, 122, 95],
                'stack'=> '2016'
              ], [
                'name'=> 'Urban-16',
                'color'=>'#FFB207',
                'data'=> [113, 122, 95],
                'stack'=> '2016'
              ]]
        ];
    }
}