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
    public $name, $description, $chart_id = 20;

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

        return view('livewire.chart20');
    }

    public function mount()
    {
        $db_data_set = DB::connection('mysql2')->select("SELECT
        fiscal_year,
        country,
        SUM(remittance_in_crore_bdt) AS remittance_in_crore_bdt
    FROM
        corona_socio_info.economy_remittance_countrywise
    WHERE
        country != 'Total'
    GROUP BY fiscal_year , country
    ORDER BY fiscal_year , country DESC");

        $this->fotmated_data_set = array();
        foreach (collect($db_data_set)->groupBy('fiscal_year') as $fiscal_year => $fiscal_year_wise_data) {
            array_push($this->fotmated_data_set, [
                'name' =>  $fiscal_year,
                'data' =>  $fiscal_year_wise_data->map(function($data){
                    return ["$data->country".'&nbsp; <img src="'.("/assets/flags/$data->country.png").'" width="20" height="20">', $data->remittance_in_crore_bdt/1000000];
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
            'chart'=> [
                'renderTo'=> 'container',
                'type'=> 'bar'
            ],
            'plotOptions'=> [
                'column'=> [
                    'stacking'=> 'normal',
                    'dataLabels'=> [
                        'enabled'=> false
                    ]
                ]
            ],
            'xAxis'=> [
                'type'=> "category",
                'labels'=> [
                    'useHTML'=> true,
                ],
            ],
            'series'=> [$this->fotmated_data_set[$selected_key_for_data_view]]
        ];
    }

    protected $listeners = ['change_selected_key_and_chart_update_20'];
    public function change_selected_key_and_chart_update_20($key)
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data($key)]);
    }
}
