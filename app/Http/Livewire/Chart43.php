<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart43 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 43;

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

        return view('livewire.chart43');
    }

    public function mount()
    {
        $db_data_set = DB::connection('mysql2')->select("(SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2008-09' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2009-10' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2010-11' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2011-12' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2012-13' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2013-14' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2014-15' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2015-16' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2016-17' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2017-18' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2018-19' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2019-20' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2020-21' 
        ORDER BY coverage DESC 
        LIMIT 5) UNION ALL (SELECT 
        year, 
        p_type, 
        p_name, 
        implementing_ministry_1, 
        implementing_ministry_2, 
        budget, 
        coverage 
        FROM 
        corona_socio_info.ssn_budget_coverage_new 
        WHERE 
        year = '2021-22' 
        ORDER BY coverage DESC 
        LIMIT 5)");

        $this->fotmated_data_set = array();
        foreach (collect($db_data_set)->groupBy('year') as $fiscal_year => $fiscal_year_wise_data) {
            array_push($this->fotmated_data_set, [
                'name' =>  $fiscal_year,
                'data' =>  $fiscal_year_wise_data->map(function ($data) {
                    return ["$data->p_name", $data->coverage];
                }),
                'color' =>  '#83C341',
            ]);
        }

        //Default render by first one or key 0
        $this->chart_data_set = $this->get_data();
    }

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
                    'text' =>  'Coverage in Lac person',
                    'style' => [
                        'fontSize' => '14px'
                    ]
                ],
                'labels' => [
                    'rotation' => -45,
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
                        'format' => "{point.y:,.2f}"
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
                'pointFormat' => '{point.name}<br>Coverage in Lac person: {point.y:,.2f}<br>Year: {series.name}',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],
            'series' =>  [$this->fotmated_data_set[$selected_key_for_data_view]]
        ];
    }

    protected $listeners = ['change_selected_key_and_chart_update_43'];
    public function change_selected_key_and_chart_update_43($key)
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data($key)]);
    }
}
