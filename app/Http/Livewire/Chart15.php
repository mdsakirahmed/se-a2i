<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\EconomyGdpCompositionSpecific;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Chart15 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 15;
    public $chart_type = 'column';

    public $chart_data_set = [];
    public $broad_sectors = [];
    public $selected_broad_sector = 'All';


    public function mount(){
        $this->chart_data_set = $this->get_data();
    }

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

        return view('livewire.chart15');
    }

    public function get_data()
    {
        $data = EconomyGdpCompositionSpecific::select('fiscal_year', 'broad_sector', 'specific_sector', 'share_gdp_constant')->get();
        $this->broad_sectors = $data->pluck('broad_sector')->unique();

        if ($this->selected_broad_sector != 'All') {
            //Query for selected 
            $data = $data->where('broad_sector', $this->selected_broad_sector);
        }
        
        $series = [];
        foreach($data->groupBy('specific_sector') as $specific_sector => $specific_sector_wise_data){
            array_push($series, [
                'name'=> Str::limit($specific_sector, 20, '......'),
                'data'=> $specific_sector_wise_data->pluck('share_gdp_constant')
            ]);
        }

        $categories = [];
        foreach ($data->pluck('fiscal_year')->unique() as $fiscal_year){
            array_push($categories, $fiscal_year);
        }

        return [
            'chart'=> [
                'type' =>  $this->chart_type
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title'=> [
                'text'=> ''
            ],
            'xAxis'=> [
                'categories'=> $categories
            ],
            'yAxis'=> [
                'min'=> 0,
                'title'=> [
                    'text'=> 'Percentage of Economy (%)'
                ]
            ],
            'legend'=> [
                'reversed'=> true
            ],
            'plotOptions'=> [
                'column'=> [
                    'stacking'=> 'normal'
                ],
            //     'series' => [
            //     'pointWidth'=> 20,
            //     'borderRadius' => '8px',
            // ]
            ],
            
            'colors'=> ['#7F3F98', '#83C341', '#FFB207'],
            'legend' => [
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle',
                'itemMarginTop' => 10,
                'itemMarginBottom' => 10,
                'margin'=> 45
            ],
            'series'=> $series,
        ];
    }

    public function chart_update(){
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }
}
