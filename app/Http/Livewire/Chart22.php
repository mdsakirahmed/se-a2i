<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart22 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 22;

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

        return view('livewire.chart22', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {

        $data_set = DB::connection('mysql2')->select("SELECT
        a.fiscal_year, a.import_in_usd, b.export_in_usd
        FROM
        (SELECT 
            id,
            fiscal_year,
            SUM(import_in_usd) AS import_in_usd
        FROM
            economy_import_country
        WHERE
            country != ('Total')
        GROUP BY fiscal_year) AS a

        INNER JOIN
        
        (SELECT 
            id,
            fiscal_year,
            SUM(export_in_usd) AS export_in_usd
        FROM
            economy_export_country
        WHERE
            country != ('Total Exports')
        GROUP BY fiscal_year) AS b ON a.fiscal_year = b.fiscal_year");

        // @dd($data_set);

        $import_export_over_the_year = [];
        foreach($data_set as $data){
            array_push($import_export_over_the_year, [
                'fiscal_year' => substr($data->fiscal_year, 0, 5).substr($data->fiscal_year, 7, 10),
                'import_in_usd' => round(((float)$data->import_in_usd)/1000000000,2),
                'export_in_usd' => round(((float)$data->export_in_usd)/1000000000,2),
            ]);
        }

        return [
            'chart' =>  [
                'type' =>  'area', 'zoomType' => 'xy'
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

            'legend' => [
                'align' => 'left',
                'verticalAlign' => 'top',
                'layout' => 'horizontal',
                'x' => 0,
                'y' => 0,
                'margin' => 45
            ],

            'subtitle' =>  [
                'text' =>  ''
            ]
            // ,'marker' =>  [
            //     'radius' =>  5
            // ]
            , 'xAxis' =>  [
                'categories' =>  collect($import_export_over_the_year)->pluck('fiscal_year'),
                'labels' => [
                    'rotation' => -45,
                    'style' => [
                        'fontSize' => '13px'
                    ]
                ]
            ],

            'yAxis' =>  [
                'title' =>  [
                    'text' =>  'Imports/Exports (Billion US$)',
                    'style'=>[
                        'fontSize'=>'14px'
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
                'line' =>  [
                    'dataLabels' =>  [
                        'enabled' =>  false
                    ], 'enableMouseTracking' =>  true
                ]
            ],

            'series' =>  [
                [
                    'name' =>  'Total imports',
                    'data' =>  collect($import_export_over_the_year)->pluck('import_in_usd'),
                    'color' =>  '#7F3F98',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ], [
                    'name' =>  'Total exports',
                    'data' =>  collect($import_export_over_the_year)->pluck('export_in_usd'),
                    'color' =>  '#83C341',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ]
            ]
        ];
    }
}
