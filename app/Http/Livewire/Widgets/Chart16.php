<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart16 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 16;

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

        return view('widgets.chart16', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        a.district,
        SUM(IF(year IN ('2017-July' , '2017-August',
                '2017-September',
                '2017-November',
                '2017-December',
                '2017-June',
                '2018-January',
                '2018-February',
                '2018-March',
                '2018-April',
                '2018-May',
                '2018-June'),
            remittance_in_million_usd,
            0)) AS 'Fiscal_year_2017_18',
        SUM(IF(year IN ('2018-July' , '2018-August',
                '2018-September',
                '2018-November',
                '2018-December',
                '2018-June',
                '2019-January',
                '2019-February',
                '2019-March',
                '2019-April',
                '2019-May',
                '2019-June'),
            remittance_in_million_usd,
            0)) AS 'Fiscal_year_2018_19',
        SUM(IF(year IN ('2019-July' , '2019-August',
                '2019-September',
                '2019-November',
                '2019-December',
                '2019-June',
                '2020-January',
                '2020-February',
                '2020-March',
                '2020-April',
                '2020-May',
                '2020-June'),
            remittance_in_million_usd,
            0)) AS 'Fiscal_year_2019_20',
        SUM(IF(year IN ('2020-July' , '2020-August',
                '2020-September',
                '2020-November',
                '2020-December',
                '2020-June',
                '2021-January',
                '2021-February',
                '2021-March',
                '2021-April',
                '2021-May',
                '2021-June'),
            remittance_in_million_usd,
            0)) AS 'Fiscal_year_2020_21',
        SUM(IF(year IN ('2021-July' , '2021-August',
                '2021-September',
                '2021-November',
                '2021-December',
                '2021-June',
                '2022-January',
                '2022-February',
                '2022-March',
                '2022-April',
                '2022-May',
                '2022-June'),
            remittance_in_million_usd,
            0)) AS 'Fiscal_year_2021_22'
        FROM
            (SELECT 
                CONCAT(year, '-', month) AS year,
                    district,
                    remittance_in_million_usd
            FROM
            economy_remittance_districtwise
            GROUP BY year , month , district) AS a
        GROUP BY district");


        dd($data);

        return [
            'chart' => [
                'type' => 'bar'
            ],
            'title' => [
                'text' => ''
            ],

            'xAxis' => [
                'categories' => collect($data)->pluck('year')
            ],
            'yAxis' => [
                'allowDecimals' => false,
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Students'
                ]
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
                'bar' => [
                    'stacking' => 'normal',
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => "{point.y:,.2f}" . '%',
                    ]
                ]
            ],
            'series' => [[
                'name' => 'Male',
                'stack' => 'gender',
                'color' => "#7F3F98",
                'data' => collect($data)->pluck('female_student')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'name' => 'Female',
                'stack' => 'gender',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('male_student')->map(function ($value) {
                    return round($value, 2);
                }),
            ]]
        ];
    }
}
