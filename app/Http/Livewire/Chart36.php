<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart36 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 36;
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
        if ($this->selected_division) {
            $this->districts = DB::connection('mysql2')->select("SELECT distinct district FROM education_covid19_impact WHERE division = '$this->selected_division'");
        } else {
            $this->districts = DB::connection('mysql2')->select("SELECT distinct district FROM education_covid19_impact");
        }

        return view('livewire.chart36', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function change_chart_type($chart_type)
    {
        $this->chart_type = $chart_type;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function change_chart_filter_by_division()
    {
        $this->selected_district = null;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function change_chart_filter_by_district()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {
        if ($this->selected_district) {
            $data = DB::connection('mysql2')->select('SELECT
            upazila_pro AS upazila_pro,
            child_labor AS child_labor,
            MAX(event_percent) AS `event_percent`
            FROM
            (SELECT
                CONCAT(UPPER(LEFT(upazila, 1)), LOWER(RIGHT(upazila, LENGTH(upazila) - 1))) AS upazila_pro,
                    child_labor,
                    COUNT(child_labor) AS child_labor_count,
                    COUNT(child_labor) * 100.0 / (SELECT
                            COUNT(*)
                        FROM
                            education_covid19_impact) AS event_percent
            FROM
                education_covid19_impact WHERE district = "' . $this->selected_district . '"
            GROUP BY upazila , child_labor) AS expr_qry
            GROUP BY upazila_pro , child_labor
            ORDER BY child_labor , upazila_pro ASC
            LIMIT 1000');
            $data = collect($data)->groupBy('upazila_pro');
            $title = 'Percentage of District';
        } else {
            if ($this->selected_division) {
                $data = DB::connection('mysql2')->select("SELECT
                district_pro AS district_pro,
                child_labor AS child_labor,
                MAX(event_percent) AS `event_percent`
            FROM
                (SELECT
                    CONCAT(UPPER(LEFT(district, 1)), LOWER(RIGHT(district, LENGTH(district) - 1))) AS district_pro,
                        child_labor,
                        COUNT(child_labor) AS child_labor_count,
                        COUNT(child_labor) * 100.0 / (SELECT
                                COUNT(*)
                            FROM
                                education_covid19_impact) AS event_percent
                FROM
                    education_covid19_impact WHERE division = '$this->selected_division'
                GROUP BY district , child_labor) AS expr_qry
                GROUP BY district_pro , child_labor
                ORDER BY child_labor , district_pro ASC
                LIMIT 1000");
                $data = collect($data)->groupBy('district_pro');
                $title = 'Percentage of District';
            } else {
                $data = DB::connection('mysql2')->select("SELECT division_pro AS division_pro,
                child_labor AS child_labor,
                max(event_percent) AS `event_percent`
                FROM
                (SELECT concat(upper(left(division, 1)), lower(right(division, length(division) - 1))) AS division_pro,
                        child_labor,
                        count(child_labor) as child_labor_count,
                        count(child_labor) * 100.0 /
                    (select count(*)
                    from education_covid19_impact) as event_percent
                    FROM education_covid19_impact
                    GROUP BY division,
                            child_labor) AS expr_qry
                GROUP BY division_pro,
                        child_labor
                        ORDER BY child_labor, division_pro ASC
                LIMIT 1000");
                $data = collect($data)->groupBy('division_pro');
                $title = 'Percentage of Upazial';
            }
        }

        $formated_data = array();
        foreach($data as $key => $value){
            array_push($formated_data, [
                'location'  => $key,
                'increased' => round($value->where('child_labor', 'Increased')->sum('event_percent'), 2),
                'decreased' => round($value->where('child_labor', 'Decreased')->sum('event_percent'), 2),
                'same'      => round($value->where('child_labor', 'Same')->sum('event_percent'), 2),
            ]); 
        }

        return [
            'chart' => [
                'type' =>  $this->chart_type
            ],
            'title' => [
                'text' => ''
            ],
            'subtitle' => [
                'text' => ''
            ], 'credits' =>  [
                'enabled' =>  false
            ],
            'xAxis' => [
                'categories' =>  collect($formated_data)->pluck('location'),
                'crosshair' => true,
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'yAxis' => [
                'min' => 0,
                'title' => [
                    'text' => $title,
                    'style'=>[
                        'fontSize'=>'15px'
                    ]
                ],
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
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
                ],
                'series' => [
                    'borderRadius' => '5px',
                ]
            ],
            'series' => [[
                'name' => 'Decreased',
                'color' => "#FFB207",
                'data' =>  collect($formated_data)->pluck('decreased'),
            ], [
                'name' => 'Increased',
                'color' => "#83C341",
                'data' => collect($formated_data)->pluck('increased'),
            ], [
                'name' => 'Same',
                'color' => "#7F3F98",
                'data' =>  collect($formated_data)->pluck('same'),
            ]],
        ];
    }
}
