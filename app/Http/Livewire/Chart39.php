<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart39 extends Component
{
    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 39;

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

        return view('livewire.chart39', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $fiscal_year, $program_type;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        fiscal_year,
        programme_name,
        programme_type,
        implementing_ministry_1,
        implementing_ministry_2,
        beneficiaries_lac_persons as value,
        budget_crore_bdt
        FROM corona_socio_info.ssn_budget_coverage");

        $this->fiscal_yeas = collect($data)->pluck('fiscal_year')->unique();
        $this->program_types = collect($data)->pluck('programme_type')->unique();

        if ($this->fiscal_year) {
            $data = collect($data)->where('fiscal_year', $this->fiscal_year);
        }

        if ($this->program_type) {
            $data = collect($data)->where('programme_type', $this->program_type);
        }

        $formated_data = [];
        foreach (collect($data)->groupBy('programme_name') as $programme_name => $data_set) {
            array_push($formated_data, [
                'fiscal_year' => collect($data_set)->pluck('fiscal_year'),
                'programme_name' => $programme_name,
                'programme_type' => collect($data_set)->pluck('programme_type'),
                'implementing_ministry_1' => collect($data_set)->pluck('implementing_ministry_1')->unique(),
                'implementing_ministry_2' => collect($data_set)->pluck('implementing_ministry_2')->unique(),
                'budget_crore_bdt' => round(collect($data_set)->sum('budget_crore_bdt'),2),
                'value' => round(collect($data_set)->sum('value'),2),
            ]);
        }

        return [
            'title' => [
                'text' => ''
            ],

            'credits' => [
                'enabled' => false
            ],
            'colors' => ['#80CE0C', '#7F3F98', '#FFB207', '#9D1941','#3F37C9','#0077B6','#05AE82','#B4F553','#D2B2DF','#FFDD92','#E6628A','#4895EF','#90E0EF','#20F9C0','#406706','#41204D','#E9680B','#5E0F27','#3A0CA3','#03045E','#06394A','#96F10E','#B47ECA','#FFC649','#DC235B','#4361EE','#00B4D8','#06DFA7'],
            'series' => [[
                'type' => 'treemap',
                'layoutAlgorithm' => 'squarified',
                'colorByPoint' => true,
                'data' => $formated_data,
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '{point.programme_name}',
                    'style' => [
                        'textShadow' => false,
                        'strokeWidth' => 0,
                        'textOutline' => false
                    ]
                ],
                'tooltip' => [
                    'useHTML' => true,
                    'pointFormat' => 'Programme name:<b>{point.programme_name}</b> <br> Budget Crore Bdt: <b>{point.budget_crore_bdt}</b> <br> Coverage (Lakh People): <b>{point.value}</b> <br>  Implementing Ministry 1:	 <b>{point.implementing_ministry_1}</b>',
                ]
            ]],
            'plotOptions' => [
                'series' => [
                    'cursor' => 'pointer'
                ],
                'treemap'=>[
                    'borderWidth'=>0,
                    'style'=>[
                        'strokeWidth'=>0
                    ]
                ]
            ],
        ];
    }
}
