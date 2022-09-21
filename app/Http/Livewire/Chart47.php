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

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $selected_column = null;
    public $selected_column_type = null;

    public function get_data()
    {
        if(!$this->selected_column)
        $this->selected_column = "poverty";
        if(!$this->selected_column_type)
        $this->selected_column_type = "lower";

        $data = DB::connection('mysql2')->select("SELECT * FROM corona_socio_info.bbs_poverty_and_sqd_poverty;");

        $regions = collect($data)->pluck('region')->unique();

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
                'categories' => $regions,
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
                ],
                'stackLabels' => [
                    'enabled' => true, 
                    'useHTML' => true,
                    'format' => '{stack}',
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
                        //'format' => '{point.series.name}'

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
            'series' => [ [
                'name' => 'National-10',
                'data' => $this->get_data_by_year_and_column(2010, $this->selected_column."_gap_national_".$this->selected_column_type),
                'color' => '#83C341',
                'stack' => '2010'
            ], [
                'name' => 'Rural-10',
                'color' => '#7F3F98',
                'data' => $this->get_data_by_year_and_column(2010, $this->selected_column."_gap_rural_".$this->selected_column_type),
                'stack' => '2010'
            ], [
                'name' => 'Urban-10',
                'color' => '#FFB207',
                'data' => $this->get_data_by_year_and_column(2010, $this->selected_column."_gap_urban_".$this->selected_column_type),
                'stack' => '2010'
            ],  [
                'name' => 'National-16',
                'data' => $this->get_data_by_year_and_column(2016, $this->selected_column."_gap_national_".$this->selected_column_type),
                'color' => '#83C341',
                'stack' => '2016'
            ], [
                'name' => 'Rural-16',
                'color' => '#7F3F98',
                'data' => $this->get_data_by_year_and_column(2016, $this->selected_column."_gap_rural_".$this->selected_column_type),
                'stack' => '2016'
            ], [
                'name' => 'Urban-16',
                'color' => '#FFB207',
                'data' => $this->get_data_by_year_and_column(2016, $this->selected_column."_gap_urban_".$this->selected_column_type),
                'stack' => '2016'
            ]]
        ];
    }

    public function get_data_by_year_and_column($year, $column){
        $data = DB::connection('mysql2')->select("SELECT * FROM corona_socio_info.bbs_poverty_and_sqd_poverty;");
        $array_data = [];
        foreach(collect($data)->where('year', $year)->pluck($column) as $column_value){
            array_push($array_data, (float)$column_value);
        }
        return $array_data;
    }

}

