<?php

namespace App\Http\Livewire\Widgets;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart1 extends Component
{
    public function render()
    {
        return view('widgets.chart1', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT 
        year,
        SUM(total_student) as total_student,
        ((SUM(female_student) * 100) / SUM(total_student)) AS female_student,
        (((SUM(total_student) - SUM(female_student)) * 100) / SUM(total_student)) AS male_student
        FROM
            corona_socio_info.education_statistics
        WHERE
            year IS NOT NULL
        GROUP BY year");

        return[
            'chart' => [
                'type' => 'column'
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
                    'text' => 'Percentage of students'
                ]
            ],
            'tooltip' => [
                'formatter' => `'<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal +'@@'`
              ],
            'plotOptions' => [
                'column' => [
                    'stacking' => 'normal'
                ]
            ],
            'series' => [[
                'name' => 'Male',
                'stack' => 'male',
                'color' => "#7F3F98",
                'data' => collect($data)->pluck('female_student')->map(function ($value) {
                    return round($value, 2);
                }),
                'dataLabels' => [
                    'enabled' => true,
                    'formatter' => `'this.point.stackTotal +'@@'`
                ]
            ], [
                'name' => 'Female',
                'stack' => 'female',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('male_student')->map(function ($value) {
                    return round($value, 2);
                }),
                // 'dataLabels' => [
                //     'enabled' => true,
                // ]
            ]]
        ];
    }
}
