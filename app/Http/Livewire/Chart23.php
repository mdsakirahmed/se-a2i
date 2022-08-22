<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart23 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 23;

    public function render()
    {
        $this->chart = Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart23');
    }

    public function mount()
    {
        $db_data_set = DB::connection('mysql2')->select("(SELECT * FROM
                economy_import_country
            WHERE
                fiscal_year = '2005-2006'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2006-2007'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2007-2008'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2008-2009'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2009-2010'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2010-2011'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2011-2012'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2012-2013'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2013-2014'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2014-2015'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2015-2016'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2016-2017'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2017-2018'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2018-2019'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2019-2020'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11) UNION ALL (SELECT 
                *
            FROM
                economy_import_country
            WHERE
                fiscal_year = '2020-2021'
                    AND country NOT IN ('Top 15' , 'Total' , 'Imports of EPZ' , 'Special Category Imports')
            ORDER BY import_in_usd DESC
            LIMIT 11)");

        $this->fotmated_data_set = array();
        foreach(collect($db_data_set)->groupBy('fiscal_year') as $fiscal_year => $fiscal_year_wise_data){
            array_push($this->fotmated_data_set, [
                'name' =>  $fiscal_year,
                'data' =>  $fiscal_year_wise_data->pluck('import_in_usd'),
                'color' =>  '#83C341',
            ]);
        }

        //Set chart's categories
        $this->categories = collect($db_data_set)->pluck('country')->unique();
        //Default render by first one or key 0
        $this->chart_data_set = $this->get_data();
    }

    public function get_data($selected_key_for_data_view = 0)
    {
        return  [
            'chart' =>  [
                'type' =>  'bar', 'zoomType' => 'xy'
            ],

            'credits' => [
                'enabled' => false
            ],

            'title' =>  [
                'text' =>  ''
            ],

            'credits' =>  [
                'enabled' =>  false
            ],

            'subtitle' =>  [
                'text' =>  ''
            ]
            // ,'marker' =>  [
            //     'radius' =>  5
            // ]
            , 'xAxis' =>  [
                'categories' =>  $this->categories,
            ],

            'yAxis' =>  [
                'title' =>  [
                    'text' =>  'Imports/Exports (Billion US$)'
                ], 'labels' =>  [
                    'format' =>  '{value}'
                ]
            ],

            'plotOptions' =>  [
                'bar' =>  [
                    'dataLabels' =>  [
                        'enabled' =>  false
                    ], 'enableMouseTracking' =>  true
                ]
            ],

            'series' =>  [$this->fotmated_data_set[$selected_key_for_data_view]]
        ];
    }

    public function change_selected_key_and_chart_update($key){
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data($key)]);
    }
}
