<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart39 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 39;

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
    
        if($this->program_type){
            $data = collect($data)->where('programme_type',$this->program_type);
        }
    
        $formated_data = [];
        foreach ($data as $data_set) {
            array_push($formated_data, [
                'fiscal_year' => $data_set->fiscal_year,
                'programme_name' => $data_set->programme_name,
                'programme_type' => $data_set->programme_type,
                'implementing_ministry_1' => $data_set->implementing_ministry_1,
                'implementing_ministry_2' => $data_set->implementing_ministry_2,
                'budget_crore_bdt' => $data_set->budget_crore_bdt,
                'value' => $data_set->value,
            ]);
        }

        return [
            'title' => [
                'text' => 'Commodity'
            ],
            'series' => [[
                'type' => 'treemap',
                'layoutAlgorithm' => 'squarified',
                'colorByPoint' => true,
                'data' => $formated_data,
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '{point.programme_name}<br>{point.value}',
                ],
                'tooltip' => [
                    'useHTML' => true,
                    'pointFormat' => 'Programme name:<b>{point.programme_name}</b> <br> Budget Crore Bdt: <b>{point.budget_crore_bdt}</b> <br> Coverage (Lakh People): <b>{point.value}</b> <br>  Implementing Ministry 1:	 <b>{point.implementing_ministry_1}</b>',
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
