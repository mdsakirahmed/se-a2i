<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart23 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 23;

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

        return view('livewire.chart23');
    }

    public function mount()
    {
        $db_data_set = DB::connection('mysql2')->select("(SELECT * FROM
                economy_import_country
            WHERE
                fiscal_year = '2005-06'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2006-07'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2007-08'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2008-09'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2009-10'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2010-11'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2011-12'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2012-13'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2013-14'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2014-15'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2015-16'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2016-17'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2017-18'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2018-19'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2019-20'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2020-21'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_million_usd DESC
            LIMIT 10)");

        $this->fotmated_data_set = array();
        foreach (collect($db_data_set)->groupBy('fiscal_year') as $fiscal_year => $fiscal_year_wise_data) {
            array_push($this->fotmated_data_set, [
                'name' =>  $fiscal_year,
                'data' =>  $fiscal_year_wise_data->map(function ($data) {
                    return ["$data->country" . '&nbsp; <img src="' . ("/assets/flags/$data->country.png") . '" width="20" height="15">', $data->import_million_usd];
                }),
                'color' =>  '#83C341',
            ]);
        }

        //Default render by first one or key 0
        $this->chart_data_set = $this->get_data();
        
    }
//dd($selected_key_for_data_view);
    public function get_data($selected_key_for_data_view = 0)
    {
        return [
            'chart' => [
                'renderTo' => 'container',
                'type' => 'bar'
            ],

            'title' => [
                'text' => ''
            ],

            'credits' => [
                'enabled' => false
            ],

            'xAxis' => [
                'type' => "category",
                'labels' => [
                    'useHTML' => true,
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],
            'yAxis' =>  [
                'title' =>  [
                    'text' =>  'Imports (Million US$)',
                    'style' => [
                        'fontSize' => '14px'
                    ]
                ],
                'labels' => [
                    'format' =>  '{value}',
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],
            'plotOptions' =>  [
                'bar' =>  [
                    'dataLabels' => [
                        'enabled' => true,
                        'inside' => false,
                        'format' => "{point.y:,.2f}",
                        'color'=> '#323232'
                    ], 
                    'enableMouseTracking' =>  true
                ],
                'series' => [
                    'animation' => false,
                    'pointWidth' => 20,
                    'borderRadius' => '8px',
                ]
            ],
            'tooltip' => [
                'shared' => true,
                'outside' => true,
                'crosshairs' => true,
                'useHTML' => true,
                'headerFormat' => '',
                'pointFormat' => 'Country: {point.name}<br>Imports In Million US$: {point.y:,.2f}<br>Year: {series.name}',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],
            'series' =>  [$this->fotmated_data_set[$selected_key_for_data_view]],
            'responsive'=> [
                'rules'=> [[
                    'condition'=> [
                        'maxWidth'=> 500
                    ],
                    'chartOptions'=> [
                        'plotOptions'=> [
                            'bar'=> [
                                'pointWidth'=> 15,
                                'borderRadius'=>'8px',
                            ],
                            'series'=>[
                                'dataLabels'=>[
                                    'style'=>[
                                        'fontSize'=>'10px'
                                    ]
                                ]
                            ]    
                        ],

                        'yAxis'=>[
                            'title' => [
                                'style'=>[
                                    'fontSize'=>'12px'
                                ]
                            ],
                            'labels'=>[
                                'style'=>[
                                    'fontSize'=>'10px'
                                ]
                            ]
                        ],
                        'xAxis'=>[
                            'labels'=>[
                                'style'=>[
                                    'fontSize'=>'10px'
                                ]
                            ]
                        ]
                            
                    ]
                ]]
            ]
        ];
    }

    protected $listeners = ['change_selected_key_and_chart_update_23'];
    public function change_selected_key_and_chart_update_23($key)
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data($key)]);
    }
}
