<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart20 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 20;

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

        return view('livewire.chart20');
    }

    public function mount()
    {
        $db_data_set = DB::connection('mysql2')->select("(SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2009-2010'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2010-2011'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2011-2012'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 11) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2012-2013'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2013-2014'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2014-2015'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2015-2016'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2016-2017'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2017-2018'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2018-2019'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10) UNION ALL (SELECT
            fiscal_year,
            country,
            SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
        FROM
            corona_socio_info.economy_remittance_countrywise
        WHERE
            fiscal_year = '2020-2021'
            AND country NOT IN ('Other Countries' , 'Total')
        GROUP BY fiscal_year , country
        ORDER BY remittance_in_crore_bdt DESC
        Limit 10)");

        $this->fotmated_data_set = array();
        foreach (collect($db_data_set)->groupBy('fiscal_year') as $fiscal_year => $fiscal_year_wise_data) {
            array_push($this->fotmated_data_set, [
                'name' =>  $fiscal_year,
                'data' =>  $fiscal_year_wise_data->map(function ($data) {
                    return ["$data->country" . '&nbsp; <img src="' . ("/assets/flags/$data->country.png") . '" width="20" height="15">', $data->remittance_in_crore_bdt];
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
            'plotOptions' => [
                'column' => [
                    'stacking' => 'normal',
                    'dataLabels' => [
                        'enabled' => true
                    ]
                ],
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
                    'text' =>  'Remittance (Crore BDT)',
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
            'tooltip' => [
                'useHTML' => true,
                'headerFormat' => '',
                'pointFormat' => 'Country: {point.name}<br>Remittance In Crore Bdt:	{point.y:,.2f}',
                'style' => [
                    'color' => '#fff'
                ],
                'valueDecimals' => 0,
                'backgroundColor' => '#444444',
                'borderColor' => '#eeee',
                'borderRadius' => 10,
                'borderWidth' => 3,
            ],
            'series' => [$this->fotmated_data_set[$selected_key_for_data_view]]
        ];
    }

    protected $listeners = ['change_selected_key_and_chart_update_20'];
    public function change_selected_key_and_chart_update_20($key)
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data($key)]);
    }
}
