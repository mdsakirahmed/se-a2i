<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Traits\DataCleanerTrait;

class Chart40 extends Component
{
    use DataCleanerTrait;

    public  Chart $chart;
    public $name, $description, $datasource, $chart_id = 40;
    public $value_type;

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

        return view('livewire.chart40', [
            'chart_data_set' => $this->get_data()
        ]);
    }

    public function filter_by_implementing_ministry_1($value)
    {
        $this->implementing_ministry_2 = null;
        $this->implementing_ministry_1 = $value;
        $this->chart_update();
    }

    public function filter_by_implementing_ministry_2($value)
    {
        $this->implementing_ministry_1 = null;
        $this->implementing_ministry_2 = $value;
        $this->chart_update();
    }

    public function chart_update()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public $year, $years, $p_type, $implementing_ministry_1, $implementing_ministry_2;
    public function get_data()
    {
        $data = DB::connection('mysql2')->select("SELECT
        domain,
        subdomain,
        year,
        p_type,
        p_sub_type,
        p_type_stage,
        p_name,
        implementing_ministry_1,
        implementing_ministry_2,
        implementing_division_1,
        implementing_division_2,
        budget,
        coverage,
        revised
        FROM corona_socio_info.ssn_budget_coverage_new");

        $this->years = collect($data)->pluck('year')->unique();
        $this->p_types = collect($data)->pluck('p_type')->unique();
        $this->implementing_ministry_1s = collect($data)->pluck('implementing_ministry_1')->unique();
        $this->implementing_ministry_2s = collect($data)->pluck('implementing_ministry_2')->unique();

        if ($this->implementing_ministry_1) {
            $data = collect($data)->where('implementing_ministry_1', $this->implementing_ministry_1);
        }

        if ($this->implementing_ministry_2) {
            $data = collect($data)->where('implementing_ministry_2', $this->implementing_ministry_2);
        }

        if ($this->year) {
            $data = collect($data)->where('year', $this->year);
        }

        if ($this->p_type) {
            $data = collect($data)->where('p_type', $this->p_type);
        }


        $formated_data = [];
        foreach (collect($data)->groupBy('implementing_ministry_1', 'implementing_ministry_2') as $ministry => $ministry_wise_data_set) {
            if(!$ministry || $ministry == ""){
                $ministry = 'N/A';
            }

            $parent_id = rand(1, 99999);
            array_push($formated_data, [
                'id' => "id_".$parent_id,
                'name' => $ministry,
            ]);

            foreach(collect($ministry_wise_data_set)->groupBy('p_name') as $p_name => $p_name_wise_data_set){
                if(!$p_name || $p_name == ""){
                    $p_name = 'N/A';
                }

                if($this->value_type == 'coverage'){
                    $value =  round(collect($p_name_wise_data_set)->sum('coverage'), 2);
                }else{
                    $value = round(collect($p_name_wise_data_set)->sum('budget'), 2);
                }
                
                array_push($formated_data, [
                    'name' =>  $this->data_clean($p_name),
                    'parent' => "id_".$parent_id,
                    'value' => $value,
                    'coverage' => round(collect($p_name_wise_data_set)->sum('coverage'), 2),
                    'budget' => round(collect($p_name_wise_data_set)->sum('budget'), 2),
                ]);
            }
        }

        if($this->value_type == 'coverage'){
            $tooltip_title =  'Coverage (Lakh People):';
        }else{
            $tooltip_title = 'Budget Crore Bdt:';
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
                'allowDrillToNode' => true,
                'animationLimit' => 1000,
                'dataLabels' => [
                    'enabled' => false
                ],
                'tooltip' => [
                    'useHTML' => true,
                    'pointFormat' => 
                    "$tooltip_title <b>{point.value}</b>",
                ],
                'levels' => [[
                    'level' => 1,
                    'dataLabels' => [
                        'enabled' => true
                    ],
                    'borderWidth' => 3,
                    'levelIsConstant' => false
                ], [
                    'level' => 1,
                    'dataLabels' => [
                        'style' => [
                            'fontSize' => '14px'
                        ]
                    ]
                ]],
                'accessibility' => [
                    'exposeAsGroupOnly' => true
                ],
                'data' =>collect($formated_data)
            ]]
        ];
    }
}
