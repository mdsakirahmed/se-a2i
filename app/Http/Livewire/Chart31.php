<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\ExportCountry;
use App\Models\SecondDatabase\ImportCountry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart31 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 31;
    public $chart_type = 'pie';

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

        return view('livewire.chart31', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function change_chart_type($chart_type)
    {
        $this->chart_type = $chart_type;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT early_marriage AS early_marriage, count(*) AS count
        FROM
        (SELECT *
            from education_covid19_impact) AS expr_qry
        GROUP BY early_marriage
        ORDER BY early_marriage DESC
        LIMIT 1000");

        return [
            'chart' =>  [
                'type' =>  $this->chart_type
            ], 'title' =>  [
                'text' =>  '' // must use title or empty
            ], 'credits' =>  [
                'enabled' =>  false
            ],
            'plotOptions'=> [
                'pie'=> [
                    'innerSize'=> 100,
                    'depth'=> 45
                ]
            ],
            'colors'=> ['#7F3F98', '#83C341', '#16507B'],
            'series' =>  [
                [
                    'name' => '', // must use title or empty
                    'data' =>  collect($data)->map(function ($value) {
                        return ['y' => round($value->count), 'name' => $value->early_marriage];
                    }),
                ]
            ]
        ];
    }
}