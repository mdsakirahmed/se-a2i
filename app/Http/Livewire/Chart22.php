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
        $imports = ImportCountry::groupBy('fiscal_year')
            ->selectRaw('sum(import_in_usd) as import_in_usd, fiscal_year')
            ->get()->toArray();

        $exports = ExportCountry::groupBy('fiscal_year')
            ->selectRaw('sum(export_in_usd) as export_in_usd, fiscal_year')
            ->get()->toArray();

        $data = [];
        foreach (collect(array_merge_recursive($imports, $exports))->groupBy('fiscal_year') as $fiscal_year => $item) {
            $import_export_data = array_merge_recursive($item[0], $item[1]);
            array_push($data, [
                'fiscal_year' =>    substr($fiscal_year ?? '', 0, 5).substr($fiscal_year ?? '', 7, 10),
                'import_in_usd' =>   round(((float)$import_export_data['import_in_usd'])/1000000000,2),
                'export_in_usd' =>   round(((float)$import_export_data['export_in_usd'])/1000000000,2),
            ]);
        }

        return [
            'chart' =>  [
                'type' =>  'area', 'zoomType' => 'xy'
            ],
            
            'credits' => [
                'enabled'=>false
            ],

            'title' =>  [
                'text' =>  ''
            ],
            
            'credits' =>  [
                'enabled' =>  false
            ],

            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0,
                'margin'=> 45
            ],
            
            'subtitle' =>  [
                'text' =>  ''
            ]
            // ,'marker' =>  [
            //     'radius' =>  5
            // ]
            , 'xAxis' =>  [
                'categories' =>  collect($data)->pluck('fiscal_year'),
                'labels'=>[
                    'rotation'=>-45,
                    'style'=>[
                        'fontSize'=>'13px'
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
                'labels'=>[
                    'format' =>  '{value}',
                    'style'=>[
                        'fontSize'=>'13px'
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
            
            'series' =>  [[
                'name' =>  'Total exports', 
                'data' =>  collect($data)->pluck('export_in_usd'),
                'color' =>  '#83C341',
                'marker' =>  [
                    'radius' =>  3
                ]
                ],[
                    'name' =>  'Total imports', 
                    'data' =>  collect($data)->pluck('import_in_usd'),
                    'color' =>  '#7F3F98',
                    'marker' =>  [
                        'radius' =>  3
                    ]
                ],

                
                    ]
        ];
    }
}
