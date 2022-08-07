<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart34 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 34;
    public $chart_type = 'column';
    public $divisions, $selected_division, $districts, $selected_district;

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

        $this->divisions = DB::connection('mysql2')->select("SELECT distinct division FROM education_covid19_impact");
        if($this->selected_division){
            $this->districts = DB::connection('mysql2')->select("SELECT distinct district FROM education_covid19_impact WHERE division = '$this->selected_division'");
        }else{
            $this->districts = DB::connection('mysql2')->select("SELECT distinct district FROM education_covid19_impact");
        }

        return view('livewire.chart34', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function change_chart_type($chart_type)
    {
        $this->chart_type = $chart_type;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function change_chart_filter()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {
        if($this->selected_division){
            $data = DB::connection('mysql2')->select("SELECT district AS district,
            early_marriage AS early_marriage,
            max(event_percent) AS `event_percent`
            FROM
            (SELECT concat(upper(left(district, 1)), lower(right(district, length(district) - 1))) AS district,
                    early_marriage,
                    count(early_marriage) as early_marriage_count,
                    count(early_marriage) * 100.0 /
                (select count(*)
                from education_covid19_impact) as event_percent
                FROM education_covid19_impact WHERE division='$this->selected_division'
                GROUP BY district,
                        early_marriage) AS expr_qry
            GROUP BY district,
                    early_marriage
            ORDER BY early_marriage, district ASC
            LIMIT 1000");
            $division_wise_change_in_early_marriage_data = collect($data)->groupBy('district');
        }else{
            $data = DB::connection('mysql2')->select("SELECT division_pro AS division_pro,
            early_marriage AS early_marriage,
            max(event_percent) AS `event_percent`
            FROM
            (SELECT concat(upper(left(division, 1)), lower(right(division, length(division) - 1))) AS division_pro,
                    early_marriage,
                    count(early_marriage) as early_marriage_count,
                    count(early_marriage) * 100.0 /
                (select count(*)
                from education_covid19_impact) as event_percent
                FROM education_covid19_impact
                GROUP BY division,
                        early_marriage) AS expr_qry
            GROUP BY division_pro,
                    early_marriage
            ORDER BY early_marriage, division_pro ASC
            LIMIT 1000");
            $division_wise_change_in_early_marriage_data = collect($data)->groupBy('division_pro');
        }

        $division_wise_change_in_early_marriage = [];
        foreach ($division_wise_change_in_early_marriage_data as $key => $value) {
            foreach ($value as $k => $v) {
                $data_format['category'] =  $key;
                $data_format['column-' . ($k + 1)] = (float) number_format($v->event_percent, 2);
            }
            $division_wise_change_in_early_marriage[] = $data_format;
        }

        $data = $division_wise_change_in_early_marriage;

        return [
            'chart' => [
                'type' =>  $this->chart_type
            ],
            'title' => [
                'text' => ''
            ],
            'subtitle' => [
                'text' => ''
            ],'credits' =>  [
                'enabled' =>  false
            ],
            'xAxis' => [
                'categories' =>  collect($data)->pluck('category'),
                'crosshair' => true
            ],
            'yAxis' => [
                'min' => 0,
                'title' => [
                    'text' => 'Percentage of Upazila'
                ]
            ],
            'tooltip' => [
                'headerFormat' => '<span style="font-size:10px">{point.key}</span><table>',
                'pointFormat' => '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' .
                    '<td style="padding:0"><b>{point.y:.5f}</b></td></tr>',
                'footerFormat' => '</table>',
                'shared' => true,
                'useHTML' => true
            ],
            'plotOptions' => [
                'column' => [
                    'pointPadding' => 0.2,
                    'borderWidth' => 0
                ]
            ],
            'series' => [[
                'name' => 'Decreased',
                'color' => "#7F3F98",
                'data' =>  collect($data)->pluck('column-1')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'name' => 'Increased',
                'color' => "#83C341",
                'data' =>  collect($data)->pluck('column-2')->map(function ($value) {
                    return round($value, 2);
                }),
            ], [
                'name' => 'Same',
                'color' => "#833341",
                'data' =>  collect($data)->pluck('column-3')->map(function ($value) {
                    return round($value, 2);
                }),
            ]],
        ];
    }
}
