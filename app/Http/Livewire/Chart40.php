<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart40 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 40;

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

        return view('livewire.chart40', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function filter_by_implementing_ministry_1($value){
        $this->implementing_ministry_1 = $value;
        $this->chart_update();
    }

    public function filter_by_implementing_ministry_2($value){
        $this->implementing_ministry_2 = $value;
        $this->chart_update();
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $fiscal_year, $program_type, $implementing_ministry_1, $implementing_ministry_2;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        fiscal_year,
        programme_name,
        programme_type,
        implementing_ministry_1,
        implementing_ministry_2,
        beneficiaries_lac_persons,
        budget_crore_bdt as value
        FROM corona_socio_info.ssn_budget_coverage");

        $this->fiscal_yeas = collect($data)->pluck('fiscal_year')->unique();
        $this->program_types = collect($data)->pluck('programme_type')->unique();
        $this->implementing_ministry_1s = collect($data)->pluck('implementing_ministry_1')->unique();
        $this->implementing_ministry_2s = collect($data)->pluck('implementing_ministry_2')->unique();

        if ($this->implementing_ministry_1) {
            $data = collect($data)->where('implementing_ministry_1', $this->implementing_ministry_1);
        }

        if ($this->implementing_ministry_2) {
            $data = collect($data)->where('implementing_ministry_2', $this->implementing_ministry_2);
        }

        if ($this->fiscal_year) {
            $data = collect($data)->where('fiscal_year', $this->fiscal_year);
        }
    
        if($this->program_type){
            $data = collect($data)->where('programme_type',$this->program_type);
        }

        $formated_data = [];
        foreach (collect($data)->groupBy('programme_name') as $programme_name => $data_set) {
            array_push($formated_data, [
                'fiscal_year' => collect($data_set)->pluck('fiscal_year'),
                'programme_name' => $programme_name,
                'programme_type' => collect($data_set)->pluck('programme_type'),
                'implementing_ministry_1' => collect($data_set)->pluck('implementing_ministry_1'),
                'implementing_ministry_2' => collect($data_set)->pluck('implementing_ministry_2'),
                'budget_crore_bdt' => collect($data_set)->sum('budget_crore_bdt'),
                'value' => collect($data_set)->sum('value'),
            ]);
        }

        return [
            'title' => [
                'text' => ''
            ],

            'credits'=>[
                'enabled'=>false
            ],

            'series' => [[
                'type' => 'treemap',
                'layoutAlgorithm' => 'squarified',
                'colorByPoint' => true,
                'data' => $formated_data,
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '{point.programme_name}<br>{point.value}',
                    'style'=>[
                        'textShadow'=>false,
                        'strokeWidth'=>0,
                        'textOutline'=>false
                    ]
                ],
                'tooltip' => [
                    'useHTML' => true,
                    'pointFormat' => 'Programme name:<b>{point.programme_name}</b> <br> Budget Crore Bdt: <b>{point.value}</b> <br> Coverage (Lakh People): <b>{point.beneficiaries_lac_persons}</b> <br>  Implementing Ministry 1:	 <b>{point.implementing_ministry_1}</b>',
                ]
            ]],
            'plotOptions' => [
                'series' => [
                    'cursor' => 'pointer'
                ]
            ],
        ];
    }
}
